<?php
/**
 * Plugin Name: PHP Version Ability
 * Plugin URI: https://example.com/php-version-ability
 * Description: Registers an ability that returns the PHP version running on the WordPress instance
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: php-version-ability
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the ability category for system information
 */
function php_version_ability_register_category() {
	wp_register_ability_category(
		'system-info',
		array(
			'label'       => __( 'System Information', 'php-version-ability' ),
			'description' => __( 'Information about the server and system environment', 'php-version-ability' ),
		)
	);
}
add_action( 'wp_abilities_api_categories_init', 'php_version_ability_register_category' );

/**
 * Register the PHP version ability
 */
function php_version_ability_register() {
	wp_register_ability(
		'system-info/php-version',
		array(
			'label'              => __( 'PHP Version', 'php-version-ability' ),
			'description'        => __( 'The version of PHP running on this WordPress instance', 'php-version-ability' ),
			'category'           => 'system-info',
			'callback'           => 'php_version_ability_get_version',
			'permission_callback' => '__return_true', // Allow public access without authentication
			'meta'               => array(
				'readonly'      => true,
				'show_in_rest'  => true,
			),
		)
	);
}
add_action( 'wp_abilities_api_init', 'php_version_ability_register' );

/**
 * Get the current PHP version
 *
 * @return string The PHP version string
 */
function php_version_ability_get_version() {
	return phpversion();
}
