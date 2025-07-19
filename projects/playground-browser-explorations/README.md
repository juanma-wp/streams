# Playground Browser Explorations

This project demonstrates how to embed and interact with a WordPress Playground instance inside a browser using an `<iframe>`. It leverages the [WordPress Playground Client](https://playground.wordpress.net/) to run WordPress in the browser, execute PHP code, and interact with the WordPress REST API.

## Features
- Embeds a live WordPress Playground in an iframe
- Runs custom PHP code in the Playground environment
- Reads and writes files in the virtual WordPress filesystem
- Makes REST API requests to the embedded WordPress instance

## Getting Started

### Prerequisites
- [Node.js](https://nodejs.org/) installed on your machine
- [npx](https://www.npmjs.com/package/npx) (comes with Node.js)

### Running Locally
1. Clone or download this repository to your local machine.
2. Open a terminal and navigate to the project directory:
   ```sh
   cd /path/to/playground-browser-explorations
   ```
3. Start a local web server using [http-server](https://www.npmjs.com/package/http-server):
   ```sh
   npx http-server
   ```
4. Open your browser and go to the URL shown in the terminal (usually [http://localhost:8080](http://localhost:8080)).
5. You should see the WordPress Playground embedded and running in your browser.

## Project Structure
- `index.html` — Main HTML file that sets up the iframe and loads the Playground client.
- `README.md` — This file.

## Notes
- The Playground client is loaded directly from the official CDN.
- You can modify the PHP code or REST API requests in `index.html` to experiment with different WordPress features.

## Resources
- [WordPress Playground Documentation](https://developer.wordpress.org/playground/)
- [Playground Client API Reference](https://github.com/WordPress/playground/blob/trunk/packages/client/README.md) 