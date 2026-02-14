<?php
/**
 * Plugin Name: WP AI Client Test
 * Description: Basic test plugin for WordPress/wp-ai-client package
 * Version: 1.0.0
 * Requires PHP: 8.1
 * Author: Test
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

// Include helper functions.
require_once __DIR__ . '/helpers.php';

// Initialize the AI Client when WordPress initializes.
add_action( 'init', 'wp_ai_sdk_demo_init' );
/**
 * Initialize any plugin functionality
 *
 * @return void
 */
function wp_ai_sdk_demo_init() {
	if ( class_exists( 'WordPress\AI_Client\AI_Client' ) ) {
		\WordPress\AI_Client\AI_Client::init();
	}
}

add_action(
	'admin_enqueue_scripts',
	static function () {
		wp_enqueue_script( 'wp-ai-client' );
	}
);

function wp_ai_sdk_demo_text_generate() {
	$text = \WordPress\AI_Client\AI_Client::prompt( 'Lyrics of a pop song about WordPress.' )->generate_text();
	return $text;
}

/**
 * Generate an AI image and save it to the WordPress uploads folder.
 *
 * @return array Array with 'url' and 'file' keys on success, or 'error' key on failure.
 */
function wp_ai_sdk_demo_image_generate() {
	// Generate the image using AI Client SDK.
	// Image generation can take 45-90+ seconds, so we need a longer timeout than the default 30s.
	$image = \WordPress\AI_Client\AI_Client::prompt( 'An image of a streamer doing a live stream about WordPress on a Friday afternoon.' )
		->using_request_options(
			\WordPress\AiClient\Providers\Http\DTO\RequestOptions::fromArray(
				array(
					'timeout' => 120, // 2 minutes.
				)
			)
		)
		->generate_image();

	// Get the image data (either from remote URL or base64).
	if ( $image->isRemote() ) {
		$image_data = wp_ai_sdk_demo_download_remote_image( $image->getUrl() );
	} elseif ( $image->isInline() ) {
		$image_data = wp_ai_sdk_demo_decode_base64_image( $image->getBase64Data() );
	} else {
		return array( 'error' => 'Unknown image format' );
	}

	// Check for errors.
	if ( is_wp_error( $image_data ) ) {
		return array( 'error' => $image_data->get_error_message() );
	}

	// Save to WordPress uploads folder.
	return wp_ai_sdk_demo_save_image_to_uploads( $image_data );
}
