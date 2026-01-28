<?php
/**
 * Helper functions for image handling.
 *
 * @package PHP_AI_Client_Test
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Download a remote image and return its binary data.
 *
 * @param string $url The URL of the image to download.
 * @return string|WP_Error Binary image data on success, WP_Error on failure.
 */
function wp_ai_sdk_demo_download_remote_image( $url ) {
	$response = wp_remote_get( $url, array( 'timeout' => 30 ) );

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return new WP_Error( 'download_failed', 'Failed to download remote image' );
	}

	return wp_remote_retrieve_body( $response );
}

/**
 * Decode base64 image data.
 *
 * @param string $base64_data Base64 encoded image data (with or without data URI scheme).
 * @return string|WP_Error Binary image data on success, WP_Error on failure.
 */
function wp_ai_sdk_demo_decode_base64_image( $base64_data ) {
	// Remove data URI scheme if present (e.g., "data:image/png;base64,").
	if ( strpos( $base64_data, 'base64,' ) !== false ) {
		$base64_data = substr( $base64_data, strpos( $base64_data, 'base64,' ) + 7 );
	}

	$image_data = base64_decode( $base64_data, true );

	if ( false === $image_data ) {
		return new WP_Error( 'decode_failed', 'Failed to decode base64 image data' );
	}

	return $image_data;
}

/**
 * Save image data to WordPress uploads folder.
 *
 * @param string $image_data Binary image data.
 * @param string $filename   Optional. Filename for the image. Default generates timestamped name.
 * @return array Array with 'url' and 'file' keys on success, or 'error' key on failure.
 */
function wp_ai_sdk_demo_save_image_to_uploads( $image_data, $filename = '' ) {
	if ( empty( $filename ) ) {
		$filename = 'ai-image-' . time() . '.png';
	}

	$upload = wp_upload_bits( $filename, null, $image_data );

	if ( ! empty( $upload['error'] ) ) {
		return array( 'error' => $upload['error'] );
	}

	return array(
		'url'  => $upload['url'],
		'file' => $upload['file'],
	);
}
