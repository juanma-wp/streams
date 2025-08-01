<?php
/**
 * Archivo con problemas de seguridad
 */

// Uso directo de $_GET sin sanitización
$user_id = $_GET['user_id'];
$action = $_POST['action'];

// Uso de funciones prohibidas/desaconsejadas
$file_contents = file_get_contents( 'http://example.com/data.txt' );

// SQL query sin preparación
global $wpdb;
$user_data = $wpdb->get_results( "SELECT * FROM users WHERE id = " . $user_id );

// Uso de eval (prohibido)
$code = 'echo "Hello World";';
eval( $code );

// Output sin escape
echo $user_data->user_name;
echo '<div>' . $action . '</div>';

// Uso de extract (problemático)
$data = $_POST;
extract( $data );

// Inclusión de archivos sin validación
include $_GET['page'] . '.php';

// Uso de create_function (deprecated)
$lambda = create_function( '$a,$b', 'return $a + $b;' );

// Nonce sin verificación
if ( $_POST['submit'] ) {
	// Procesar formulario sin verificar nonce
	update_option( 'my_option', $_POST['value'] );
}

// Uso de funciones de filesystem sin WP_Filesystem
file_put_contents( 'log.txt', $log_data );