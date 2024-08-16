<?php 
/*
 * Plugin Name: Mi plugin que registra bloques
 */

function my_first_block___register_block() {
    register_block_type( __DIR__ . '/build/block.json' );
}

add_action( 'init', 'my_first_block___register_block' );