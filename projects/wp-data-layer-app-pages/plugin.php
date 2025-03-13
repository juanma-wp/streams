<?php
/*
 * Plugin Name: WP Data Layer App Pages
 */

 function my_admin_menu() {
    // Create a new admin page for our app.
    add_menu_page(
        __( 'WP Data Layer App Pages', 'stream_february_juanma' ),
        __( 'WP Data Layer App Pages', 'stream_february_juanma' ),
        'manage_options',
        'wp-data-layer-app-pages',
        function () {
            echo '
            <h2>Pages</h2>
            <div id="wp-data-layer-app-pages"></div>
        ';
        },
        'dashicons-schedule',
        3
    );
}
 
add_action( 'admin_menu', 'my_admin_menu' );

function load_custom_wp_admin_scripts( $hook ) {
    // Load only on ?page=my-first-gutenberg-app.
    if ( 'toplevel_page_wp-data-layer-app-pages' !== $hook ) {
        return;
    }
 
    // Load the required WordPress packages.
 
    // Automatically load imported dependencies and assets version.
    $asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';
 
    // Enqueue CSS dependencies.
    foreach ( $asset_file['dependencies'] as $style ) {
        wp_enqueue_style( $style );
    }
 
    // Load our app.js.
    wp_register_script(
        'wp-data-layer-app-pages',
        plugins_url( 'build/index.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );
    wp_enqueue_script( 'wp-data-layer-app-pages' );
 
    // Load our style.css.
    wp_register_style(
        'wp-data-layer-app-pages',
        plugins_url( 'build/style-index.css', __FILE__ ),
        array(),
        $asset_file['version']
    );
    wp_enqueue_style( 'wp-data-layer-app-pages' );
}
 
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_scripts' );