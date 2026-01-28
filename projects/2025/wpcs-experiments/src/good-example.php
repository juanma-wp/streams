<?php
/**
 * Archivo que sigue correctamente los estándares de WordPress
 *
 * @package WPCS_Experiments
 */

/**
 * Procesa datos de usuario de forma segura
 *
 * @param array $user_data Datos del usuario a procesar.
 * @return array|false Datos procesados o false en caso de error.
 */
function wpcs_process_user_data( $user_data ) {
	if ( empty( $user_data ) || ! is_array( $user_data ) ) {
		return false;
	}

	$processed_data = array();
	
	foreach ( $user_data as $key => $value ) {
		$sanitized_key   = sanitize_key( $key );
		$sanitized_value = sanitize_text_field( $value );
		
		if ( ! empty( $sanitized_key ) ) {
			$processed_data[ $sanitized_key ] = $sanitized_value;
		}
	}
	
	return $processed_data;
}

/**
 * Clase para gestionar el procesamiento de datos
 *
 * @since 1.0.0
 */
class WPCS_Data_Processor {

	/**
	 * Configuración del procesador
	 *
	 * @var array
	 */
	private $settings;

	/**
	 * Constructor de la clase
	 *
	 * @param array $settings Configuración inicial del procesador.
	 */
	public function __construct( $settings = array() ) {
		$this->settings = wp_parse_args(
			$settings,
			array(
				'sanitize_data' => true,
				'validate_data' => true,
			)
		);
	}

	/**
	 * Procesa datos con opciones específicas
	 *
	 * @param array $data    Datos a procesar.
	 * @param array $options Opciones de procesamiento.
	 * @return array|WP_Error Datos procesados o error.
	 */
	public function process_data( $data, $options = array() ) {
		if ( empty( $data ) || ! is_array( $data ) ) {
			return new WP_Error(
				'invalid_data',
				__( 'Los datos proporcionados no son válidos.', 'wpcs-experiments' )
			);
		}

		$merged_options = wp_parse_args( $options, $this->settings );
		
		if ( $merged_options['sanitize_data'] ) {
			$data = $this->sanitize_data( $data );
		}

		if ( $merged_options['validate_data'] ) {
			$validation_result = $this->validate_data( $data );
			if ( is_wp_error( $validation_result ) ) {
				return $validation_result;
			}
		}

		return $data;
	}

	/**
	 * Sanitiza los datos de entrada
	 *
	 * @param array $data Datos a sanitizar.
	 * @return array Datos sanitizados.
	 */
	private function sanitize_data( $data ) {
		$sanitized_data = array();
		
		foreach ( $data as $key => $value ) {
			$clean_key   = sanitize_key( $key );
			$clean_value = sanitize_text_field( $value );
			
			if ( ! empty( $clean_key ) ) {
				$sanitized_data[ $clean_key ] = $clean_value;
			}
		}
		
		return $sanitized_data;
	}

	/**
	 * Valida los datos procesados
	 *
	 * @param array $data Datos a validar.
	 * @return bool|WP_Error True si es válido, WP_Error si no.
	 */
	private function validate_data( $data ) {
		if ( empty( $data ) ) {
			return new WP_Error(
				'empty_data',
				__( 'Los datos están vacíos después del procesamiento.', 'wpcs-experiments' )
			);
		}

		return true;
	}
}