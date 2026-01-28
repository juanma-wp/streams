<?php
/**
 * Plugin Name: DataForm Example
 * Plugin URI: https://example.com
 * Description: Simple DataForm testing plugin
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * Text Domain: dataform-example
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin constants
define( 'DATAFORM_EXAMPLE_URL', plugin_dir_url( __FILE__ ) );
define( 'DATAFORM_EXAMPLE_PATH', plugin_dir_path( __FILE__ ) );

// Enqueue scripts
function dataform_example_enqueue_scripts( $hook ) {
	if ( 'toplevel_page_dataform-example' !== $hook ) {
		return;
	}

	$asset_file = include DATAFORM_EXAMPLE_PATH . 'build/index.asset.php';

	wp_enqueue_script(
		'dataform-example-script',
		DATAFORM_EXAMPLE_URL . 'build/index.js',
		$asset_file['dependencies'],
		$asset_file['version'],
		true
	);
}
add_action( 'admin_enqueue_scripts', 'dataform_example_enqueue_scripts' );

// Add admin menu
function dataform_example_add_menu() {
	add_menu_page(
		'DataForm Example',
		'DataForm Example',
		'manage_options',
		'dataform-example',
		'dataform_example_render_page',
		'dashicons-forms',
		30
	);
}
add_action( 'admin_menu', 'dataform_example_add_menu' );

// Render admin page
function dataform_example_render_page() {
	?>
	<div class="wrap">
		<h1>DataForm Example</h1>
		<div id="dataform-example-root"></div>
	</div>
	<?php
}
