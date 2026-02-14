<?php
/**
 * Plugin Name: My Abilities
 * Description: A plugin to manage my abilities
 * Version: 1.0.0
 * Author: JuanMa Garrido
 * Author URI: https://juanma.dev
 * Text Domain: my-abilities
 * Domain Path: /languages
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least: 6.7
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Simply register a WordPress ability.
add_action(
	'wp_abilities_api_init',
	function () {
		wp_register_ability(
			'my-plugin/get-posts',
			array(
				'label'               => 'Get Posts',
				'description'         => 'Retrieve WordPress posts with optional filtering',
				'meta'                => array(
					'show_in_rest' => true,
					'mcp'          => array(
						'public' => true,  // Required for MCP access
						'type'   => 'tool', // Optional: 'tool' (default), 'resource', or 'prompt'
					),
				),
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => array(
						'numberposts' => array(
							'type'        => 'integer',
							'description' => 'Number of posts to retrieve',
							'default'     => 5,
							'minimum'     => 1,
							'maximum'     => 100,
						),
						'post_status' => array(
							'type'        => 'string',
							'description' => 'Post status to filter by',
							'enum'        => array( 'publish', 'draft', 'private' ),
							'default'     => 'publish',
						),
					),
				),
				'output_schema'       => array(
					'type'  => 'array',
					'items' => array(
						'type'       => 'object',
						'properties' => array(
							'ID'           => array( 'type' => 'integer' ),
							'post_title'   => array( 'type' => 'string' ),
							'post_content' => array( 'type' => 'string' ),
							'post_date'    => array( 'type' => 'string' ),
							'post_author'  => array( 'type' => 'string' ),
						),
					),
				),
				'execute_callback'    => function ( $input ) {
					$args = array(
						'numberposts' => $input['numberposts'] ?? 5,
						'post_status' => $input['post_status'] ?? 'publish',
					);
					return get_posts( $args );
				},
				'permission_callback' => function () {
					return current_user_can( 'read' );
				},
			)
		);
	}
);
