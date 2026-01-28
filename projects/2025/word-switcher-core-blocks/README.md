# Word Switcher Core Blocks

A WordPress plugin that provides a custom block format for the Block Editor (Gutenberg), allowing users to mark words or phrases separated by commas in paragraphs and headings as "switchable". These marked words will automatically cycle through a list of alternatives on the frontend, creating a dynamic text effect.

## Features

- **Rich Text Format**: Adds a toolbar button to the block editor for marking text as a "Word Switcher" area.
- **Dynamic Frontend**: Marked words cycle through alternatives with a fade animation every 5 seconds.
- **Works with Core Blocks**: Supports `core/paragraph` and `core/heading` blocks.
- **Interactive API**: Uses the new WordPress Interactivity API for smooth, state-driven frontend updates.
- **Custom Styles**: Includes CSS for smooth transitions and animations.

## How It Works

1. In the block editor, select text in a paragraph or heading block with several words separated by commas and click the "Word Switcher" toolbar button.
2. The selected text is wrapped in a `<span class="word-switcher">` element.
3. On the frontend, the plugin cycles through comma-separated words inside each `word-switcher` span, fading between them.

## Installation

1. Clone or download this repository.
2. Run `npm install` to install dependencies.
3. Build the assets with `npm run build` (or `npm start` for development).
4. Upload the plugin to your WordPress site's `wp-content/plugins/` directory, or install via the WordPress admin.
5. Activate the plugin from the WordPress Plugins screen.

## Usage

- In the WordPress block editor, add a Paragraph or Heading block.
- Highlight the word(s) you want to switch and click the "Word Switcher" button in the toolbar.
- Enter comma-separated alternatives (e.g., `fast, easy, fun`).
- Save and view the post/page on the frontend to see the words cycle.

## Development

- **Build**: `npm run build` (production) or `npm start` (development with watch mode)
- **Format/Lint**: `npm run format`, `npm run lint:js`, `npm run lint:css`
- **Scripts**: Uses `@wordpress/scripts` for build and development.
- **Webpack**: Custom entry points for format type and interactivity API modules.

## File Structure

- `plugin.php` – Main plugin file, registers scripts, styles, and block rendering logic.
- `src/registerFormatType.js` – Registers the custom rich text format and toolbar button.
- `src/iApi.js` – Handles frontend interactivity (cycling words, fade effect).
- `src/style.scss` – Styles for the word switcher effect.
- `src/block.json` – Block metadata.
- `webpack.config.js` – Custom Webpack configuration for multiple entry points.

## License

GPL-2.0-or-later. See [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html).

## Credits

Created by The WordPress Contributors. Scaffolded with the [Create Block](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-create-block/) tool. 