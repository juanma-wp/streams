<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Get duration from block attributes (default to 60 seconds)
$duration_in_seconds = isset( $attributes['durationInSeconds'] ) ? absint( $attributes['durationInSeconds'] ) : 60;

// Helper function to format time
$format_time = function( $seconds ) {
	$mins = floor( $seconds / 60 );
	$secs = $seconds % 60;
	return sprintf( '%02d:%02d', $mins, $secs );
};

// Generates a unique id for this block instance
$unique_id = wp_unique_id( 'countdown-timer-' );

// Set up initial context for this countdown timer instance
$context = array(
	'timeRemaining' => $duration_in_seconds,
	'initialDuration' => $duration_in_seconds,
	'isRunning' => false,
	'isFinished' => false,
);
?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="create-block/countdown-timer"
	<?php echo wp_interactivity_data_wp_context( $context ); ?>
	data-wp-init="callbacks.initTimer"
	class="countdown-timer"
>
	<div class="countdown-timer__display">
		<div
			class="countdown-timer__time"
			data-wp-text="callbacks.formatTime"
			role="timer"
			aria-live="polite"
			aria-atomic="true"
		>
			<?php echo esc_html( $format_time( $duration_in_seconds ) ); ?>
		</div>
		<div
			class="countdown-timer__message"
			data-wp-bind--hidden="!context.isFinished"
			role="status"
			aria-live="polite"
			aria-atomic="true"
		>
			<?php esc_html_e( 'Time\'s up!', 'countdown-timer' ); ?>
		</div>
	</div>
</div>
