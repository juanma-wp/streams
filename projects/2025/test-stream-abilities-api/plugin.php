<?php

/*
* Plugin Name: Test Stream Abilities API
* Description: Test the stream abilities API
* Version: 1.0.0
* Author: Your Name
* Author URI: https://yourwebsite.com
* Text Domain: test-stream-abilities-api
* Domain Path: /languages
* License: GPL-2.0-or-later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Requires at least: 6.0
* Requires PHP: 8.0
*/

// First, register a category, or use one of the existing categories.
add_action('abilities_api_categories_init', 'my_plugin_register_category');
function my_plugin_register_category()
{
    wp_register_ability_category('site-information', array(
        'label' => __('Site Information', 'my-plugin'),
        'description' => __('Abilities that provide information about the WordPress site.', 'my-plugin'),
    ));
}

// Then, register an ability in that category
add_action('abilities_api_init', 'my_plugin_register_site_info_ability');
function my_plugin_register_site_info_ability()
{
    wp_register_ability('my-plugin/get-site-info', array(
        'label' => __('Get Site Information', 'my-plugin'),
        'description' => __('Retrieves basic information about the WordPress site including name, description, and URL.', 'my-plugin'),
        'category' => 'site-information',
        'input_schema' => array(
            'type' => 'object',
            'properties' => array(),
            'additionalProperties' => false
        ),
        'output_schema' => array(
            'type' => 'object',
            'properties' => array(
                'name' => array(
                    'type' => 'string',
                    'description' => 'Site name'
                ),
                'description' => array(
                    'type' => 'string',
                    'description' => 'Site tagline'
                ),
                'url' => array(
                    'type' => 'string',
                    'format' => 'uri',
                    'description' => 'Site URL'
                )
            )
        ),
        'execute_callback' => function ($input) {
            return array(
                'name' => get_bloginfo('name'),
                'description' => get_bloginfo('description'),
                'url' => home_url()
            );
        },
        'permission_callback' => '__return_true',
        'meta' => array(
            'annotations' => array(
                'readonly' => true,
                'destructive' => false
            ),
            'show_in_rest' => true,
        ),
    ));
}

function my_plugin_get_siteinfo()
{
    return array(
        'name' => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'url' => home_url()
    );
}
add_action('mcp_adapter_init', function ($adapter) {
    $adapter->create_server(
        'my-server-id',                    // Unique server identifier
        'my-namespace',                    // REST API namespace
        'mcp',                            // REST API route
        'My MCP Server',                  // Server name
        'Description of my server',       // Server description
        'v1.0.0',                        // Server version
        [                                 // Transport methods
            \WP\MCP\Transport\Http\RestTransport::class,
        ],
        \WP\MCP\Infrastructure\ErrorHandling\ErrorLogMcpErrorHandler::class, // Error handler
        \WP\MCP\Infrastructure\Observability\NullMcpObservabilityHandler::class, // Observability handler
        ['my-plugin/get-site-info'],         // Abilities to expose as tools
        [],                              // Resources (optional)
        []                               // Prompts (optional)
    );
});


function example_enqueue_editor_assets()
{
    $site_info_ability = wp_get_ability('my-plugin/get-site-info');

    if ($site_info_ability) {
        $site_info = $site_info_ability->execute(array());
        error_log(print_r($site_info, true));
    } else {
        error_log('Site info ability not found');
    }

    wp_enqueue_script(
        'abilities-api-editor-scripts',
        plugins_url('index.js', __FILE__),
        array('wp-abilities'),
        filemtime(plugin_dir_path(__FILE__) . '/index.js')
    );
}
add_action('enqueue_block_editor_assets', 'example_enqueue_editor_assets');
