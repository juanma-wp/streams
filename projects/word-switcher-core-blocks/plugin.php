<?php

/**
 * Plugin Name:       Word Switcher Core Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       word-switcher
 *
 * @package StreamsApril
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function word_switcher_core_blocks_register_assets()
{

	$dir = plugin_dir_path(__FILE__);
	$script_asset_path = "$dir/build/registerFormatType.asset.php";

	if (! file_exists($script_asset_path)) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "word-switcher-core-blocks" block first.'
		);
	}

	$script_asset = require($script_asset_path);

	wp_register_script(
		'word-switcher-core-blocks-register-format-type',
		plugins_url('build/registerFormatType.js', __FILE__),
		$script_asset['dependencies'],
		$script_asset['version'],
		true // load in footer
	);

	$script_iApi_asset_path = "$dir/build/iApi.asset.php";

	if (! file_exists($script_iApi_asset_path)) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "word-switcher-core-blocks" block first.'
		);
	}

	$script_iApi_asset = require($script_iApi_asset_path);

	wp_register_script_module(
		'word-switcher-core-blocks-iApi',
		plugins_url('build/iApi.js', __FILE__),
		$script_iApi_asset['dependencies'],
		$script_iApi_asset['version'],
		true // load in footer
	);

	wp_register_style(
		'word-switcher-core-blocks-style-iApi',
		plugins_url('build/style-iApi.css', __FILE__),
		array(),
		filemtime(plugin_dir_path(__FILE__) . 'build/style-iApi.css')
	);
}

add_action('init', 'word_switcher_core_blocks_register_assets');

function word_switcher_core_blocks_enqueue_block_editor_assets()
{
	wp_enqueue_script(
		'word-switcher-core-blocks-register-format-type'
	);
}

add_action('enqueue_block_editor_assets', 'word_switcher_core_blocks_enqueue_block_editor_assets');

add_filter("render_block", "word_switcher_core_blocks_render_block", 10, 2);

function word_switcher_core_blocks_render_block($block_content, $block)
{
	$allowed_blocks = ['core/paragraph', 'core/heading'];
	if (!in_array($block['blockName'], $allowed_blocks)) {
		return $block_content;
	}

	if (strpos($block_content, 'class="word-switcher"') === false) {
		return $block_content;
	}

	$processor = new WP_HTML_Tag_Processor($block_content);

	if (!$processor->next_tag()) {
		// No tag found 
		return $block_content;
	}

	$processor->set_bookmark("parent");

	$words = [];

	while ($processor->next_tag(['tag_name' => 'span', 'class_name' => 'word-switcher'])) {
		$processor->set_attribute("data-wp-text", "state.currentWord");
		$processor->set_attribute("data-wp-class--fade", "context.isFading");

		if ($processor->next_token()) {
			$text_content = $processor->get_modifiable_text();
			if ($text_content) {
				$words = array_map('trim', explode(',', $text_content));
				$words = array_filter($words);
			}
		}
	}

	$processor->seek("parent");

	$processor->set_attribute("data-wp-interactive", "streams-may/word-switcher-core-blocks");
	$processor->set_attribute("data-wp-init", "callbacks.init");
	$processor->set_attribute("data-wp-context", json_encode([
		"words" => $words,
		"currentIndex" => 0,
		"isFading" => false
	]));

	if (! is_admin()) {
		wp_enqueue_script_module(
			'word-switcher-core-blocks-iApi'
		);
		wp_enqueue_style(
			'word-switcher-core-blocks-style-iApi'
		);
	}

	return $processor->get_updated_html();
}
