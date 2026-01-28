<?php
/**
 * Example experiment implementation.
 *
 * @package WordPress\AI
 */

declare( strict_types=1 );

namespace WordPress\AI\Experiments\My_Experiment;

use WordPress\AI\Abstracts\Abstract_Experiment;
use WordPress\AI\Asset_Loader;

/**
 * Reference experiment demonstrating hooks and REST endpoints.
 *
 * @since 0.1.0
 */
class My_Experiment extends Abstract_Experiment {
	/**
	 * {@inheritDoc}
	 *
	 * @since 0.1.0
	 */
	protected function load_experiment_metadata(): array {
		return array(
			'id'          => 'my-experiment',
			'label'       => __( 'My Experiment', 'ai' ),
			'description' => __( 'Description of what my experiment does.', 'ai' ),
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @since 0.1.0
	 */
	public function register(): void {
		error_log( 'My Experi____ment registered (loaded/enabled' );
		add_action( 'wp_footer', array( $this, 'add_footer_content' ), 20 );
		add_filter( 'document_title_parts', array( $this, 'modify_title' ), 10, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'rest_api_init', array( $this, 'register_rest_route' ) );
	}

	/**
	 * Enqueues and localizes the admin script.
	 *
	 * @since 0.1.0
	 *
	 * @param string $hook_suffix The current admin page hook suffix.
	 */
	public function enqueue_assets( string $hook_suffix ): void {
		Asset_Loader::enqueue_script( 'my-experiment', 'index' );
		Asset_Loader::localize_script(
			'my-experiment',
			'MyExperimentData',
			array(
				'enabled' => $this->is_enabled(),
			)
		);
	}

	/**
	 * Adds example content to the footer for logged-in users.
	 *
	 * @since 0.1.0
	 */
	public function add_footer_content(): void {
		if ( ! is_user_logged_in() ) {
			return;
		}

		echo '<!-- Example Experiment: AI Plugin Active -->';
	}

	/**
	 * Modifies the document title parts when debugging.
	 *
	 * @since 0.1.0
	 *
	 * @param array<string, string> $title Title parts.
	 * @return array<string, string>
	 */
	public function modify_title( array $title ): array {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG && isset( $title['site'] ) ) {
			$title['site'] = $title['site'] . ' [AI]';
		}
		return $title;
	}

	/**
	 * Registers the example REST API route.
	 *
	 * @since 0.1.0
	 */
	public function register_rest_route(): void {
		error_log( 'My Experiment REST route registered' );
		register_rest_route(
			'ai/v1',
			'/my-experiment',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rest_endpoint_callback' ),
				'permission_callback' => array( $this, 'rest_permission_callback' ),
			)
		);
	}

	/**
	 * Callback for the example REST endpoint.
	 *
	 * @since 0.1.0
	 *
	 * @return array<string, mixed>
	 */
	public function rest_endpoint_callback(): array {
		return array(
			'experiment_id' => $this->get_id(),
			'label'         => $this->get_label(),
			'description'   => $this->get_description(),
			'enabled'       => $this->is_enabled(),
			'message'       => __( 'Example experiment is active!', 'ai' ),
		);
	}

	/**
	 * Permission check for the REST endpoint.
	 *
	 * @since 0.1.0
	 *
	 * @return bool
	 */
	public function rest_permission_callback(): bool {
		//return current_user_can( 'manage_options' );
		return true;
	}
}
