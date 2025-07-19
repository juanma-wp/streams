import {
  test,
  expect,
  describe,
  beforeEach,
  afterAll,
  beforeAll,
} from "vitest";
import { type PHPRequestHandler, type PHP } from "@php-wasm/universal";
import { runCLI, RunCLIServer } from "@wp-playground/cli";
import { login } from "@wp-playground/blueprints";
import { readFileSync } from "fs";
import { resolve } from "path";
import makeFetchCookie from "fetch-cookie";

const fetchCookie = makeFetchCookie(fetch);

const getAuthHeaders = async (handler: PHPRequestHandler) => {
  const php = await handler.getPrimaryPhp();
  if (!(await php.fileExists("/wordpress/get_rest_auth_data.php"))) {
    // Verifica si existe el archivo que genera el nonce para autenticación REST API
    await php.writeFile(
      "/wordpress/get_rest_auth_data.php",
      `<?php
            require_once '/wordpress/wp-load.php';
            echo json_encode(
                array(
                    'X-WP-Nonce' => wp_create_nonce('wp_rest'),
                )
            );
            `
    );
  }
  await login(php, {
    username: "admin",
  });
  const response = await fetchCookie(
    handler.absoluteUrl + "/get_rest_auth_data.php"
  );
  return await response.json();
};

describe("Workshop Tests", () => {
  let cliServer: RunCLIServer;
  let handler: PHPRequestHandler;
  let php: PHP;
  let apiUrl;

  beforeAll(async () => {
    const blueprint = JSON.parse(
      readFileSync(resolve("./blueprint.json"), "utf8")
    );
    cliServer = await runCLI({
      command: "server",
      mount: [
        {
          hostPath: "./",
          vfsPath: "/wordpress/wp-content/plugins/playground-testing-demo",
        },
      ],
      blueprint,
      quiet: true,
    });
    handler = cliServer.requestHandler;
    php = await handler.getPrimaryPhp();
    apiUrl = new URL("/wp-json/PTD/v1/message", handler.absoluteUrl);

    // CRITICAL: Make a warmup request to ensure WordPress is fully initialized
    // This ensures REST API routes are properly registered before testing
    const warmupUrl = new URL("/wp-json/", handler.absoluteUrl);
    await fetchCookie(warmupUrl.toString());
  });

  beforeEach(async () => {
    await php.run({
      code: `
        <?php
        require_once '/wordpress/wp-load.php';
        delete_option(PTD\\OPTIONS_KEY);
      `,
    });
  });

  afterAll(async () => {
    if (cliServer) {
      await cliServer.server.close();
    }
  });

  test("Should activate plugin", async () => {
    const activePlugins = await php.run({
      code: `
        <?php
        require_once '/wordpress/wp-load.php';
        echo json_encode(get_option('active_plugins'));
      `,
    });
    expect(activePlugins.json).toContain(
      "playground-testing-demo/playground-testing-demo.php"
    );
  });

  test("Should fail to get API endpoint response for non-logged in user", async () => {
    const formData = new FormData();
    formData.append("message", "John Doe");
    const response = await fetchCookie(apiUrl.toString(), {
      method: "POST",
      body: formData,
    });
    expect(response.status).toBe(401); 
    expect(response.statusText).toBe("Unauthorized");
  });

  test("Should get API endpoint response for logged in user", async () => {
    const authHeaders = await getAuthHeaders(handler);
    const formData = new FormData();
    formData.append("message", "John Doe"); 
    const apiResponse = await fetchCookie(apiUrl, {
      method: "POST",
      headers: authHeaders,
      body: formData,
    });
    const responseJson = await apiResponse.json();
    expect(apiResponse.status).toBe(200);
    expect(responseJson).toMatchObject({
      success: true,
      message: "User says: John Doe",
    });
  });

    test("Should return 400 when message parameter is missing", async () => {
      const authHeaders = await getAuthHeaders(handler);
      const apiResponse = await fetchCookie(apiUrl, {
        method: "POST",
        headers: authHeaders,
      });
      expect(apiResponse.status).toBe(400);
      expect(apiResponse.statusText).toBe("Bad Request");
    });

    test("Should sanitize API request input", async () => {
      const formData = new FormData();
      formData.append("message", "<script>alert('XSS')</script>");
      const authHeaders = await getAuthHeaders(handler);
      const apiResponse = await fetchCookie(apiUrl, {
        method: "POST",
        headers: authHeaders,
        body: formData,
      });

      const jsonResponse = await apiResponse.json();
      expect(apiResponse.status).toBe(200);
      expect(jsonResponse.success).toBe(true);
      expect(jsonResponse.message).toBe("User says: ");
    });

    test("Should save message after API request", async () => {
    const formData = new FormData();
    formData.append("message", "John Doe");
    const authHeaders = await getAuthHeaders(handler);
    await fetchCookie(apiUrl, {
      method: "POST",
      headers: authHeaders,
      body: formData,
    });

    const result = await php.run({
      code: `
        <?php
        require_once '/wordpress/wp-load.php';
        echo json_encode(array(
          'message' => PTD\\get_messages()
        ));
      `,
    });
    expect(result.json.message.length).toBe(1);
    expect(result.json.message[0]).toBe("User says: John Doe");
  });

});
