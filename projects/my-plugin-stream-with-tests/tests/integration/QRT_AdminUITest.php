<?php

class QRT_AdminUITest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        wp_set_current_user($this->factory()->user->create(['role' => 'administrator']));
    }

    public function test_admin_menu_registration()
    {
        $this->assertIsNumeric(has_action('admin_menu', 'qrt_register_settings_page'));
    }

    public function test_settings_page_capability_check()
    {
        wp_set_current_user($this->factory()->user->create(['role' => 'subscriber']));

        ob_start();
        qrt_render_settings_page();
        $output = ob_get_clean();

        $this->assertEmpty($output);
    }

    public function test_settings_page_renders_for_admin()
    {
        update_option('qrt_wpm', 250);

        ob_start();
        qrt_render_settings_page();
        $output = ob_get_clean();

        $this->assertStringContainsString('Quick Reading Time Settings', $output);
        $this->assertStringContainsString('Words Per Minute', $output);
        $this->assertStringContainsString('value="250"', $output);
        $this->assertStringContainsString('form-table', $output);
    }

    public function test_settings_page_default_value()
    {
        delete_option('qrt_wpm');

        ob_start();
        qrt_render_settings_page();
        $output = ob_get_clean();

        $this->assertStringContainsString('value="200"', $output);
    }

    public function test_settings_page_form_fields()
    {
        ob_start();
        qrt_render_settings_page();
        $output = ob_get_clean();

        $this->assertStringContainsString('name="qrt_wpm"', $output);
        $this->assertStringContainsString('type="number"', $output);
        $this->assertStringContainsString('id="qrt_wpm"', $output);
        $this->assertStringContainsString('min="1"', $output);
        $this->assertStringContainsString('options.php', $output);
    }

    public function test_settings_page_security_fields()
    {
        ob_start();
        qrt_render_settings_page();
        $output = ob_get_clean();

        $this->assertStringContainsString('qrt_settings_group', $output);
    }
}
