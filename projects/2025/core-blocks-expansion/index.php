<?php

/**
 * Plugin Name: Core Blocks Expansion
 * Description: This plugin expands the core blocks with new features.
 * Version: 1.0.0
 * Author: Your Name
 */

define('CORE_BLOCKS_EXPANSION_DIR', plugin_dir_path(__FILE__));
define('CORE_BLOCKS_EXPANSION_URL', plugin_dir_url(__FILE__));

function example_enqueue_editor_assets()
{
    $script_path = CORE_BLOCKS_EXPANSION_URL . 'build/index.js';
    $assets_path = CORE_BLOCKS_EXPANSION_URL . 'build/index.asset.php';

    $script_dependencies = file_exists($assets_path) ? require $assets_path : array();

    wp_enqueue_script(
        'expanding-core-blocks',
        $script_path,
        $script_dependencies,
        filemtime($script_path),
        true
    );
}

add_action('enqueue_block_editor_assets', 'example_enqueue_editor_assets');


function my_plugin_enqueue_block_styles()
{

    wp_enqueue_style(
        'my-plugin-block-styles',
        plugins_url('assets/core-image.css', __FILE__),
        array(),
        filemtime(CORE_BLOCKS_EXPANSION_DIR . 'assets/core-image.css')
    );
}

add_action('init', 'my_plugin_enqueue_block_styles');
