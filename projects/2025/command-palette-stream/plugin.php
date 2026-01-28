<?php
/**
 * Plugin Name: My Command Palette Expander Plugin
 * Plugin URI: https:// example.com/my-custom-plugin
 * Description: A custom WordPress plugin .
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https:// example.com
 * License: GPL2
 */

add_action( 'admin_init', 'devblog_command_api_editor_assets', 9999 );

/**
 * Enqueue the script from build folder.
 */
function devblog_command_api_editor_assets() {
	$asset_file = trailingslashit( __DIR__ ) . 'build/index.asset.php';

	if ( file_exists( $asset_file ) ) {
		$asset = include $asset_file;

		wp_enqueue_script(
			'devblog-command-api',
			trailingslashit( plugin_dir_url( __FILE__ ) ) . 'build/index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);
	}
}
