/**
 * WordPress dependencies
 */
import { store, getContext, getElement } from '@wordpress/interactivity';

// Store to track active timer intervals
const timers = new Map();

store( 'create-block/countdown-timer', {
	callbacks: {
		/**
		 * Initialize the countdown timer when the component mounts
		 */
		initTimer: () => {
			const context = getContext();
			const { ref: blockElement } = getElement();

			// Get a unique identifier for this block instance
			const blockId =
				blockElement.getAttribute( 'data-wp-interactive' ) +
				'-' +
				Math.random();

			// Clear any existing timer for this block
			if ( timers.has( blockId ) ) {
				clearInterval( timers.get( blockId ) );
			}

			// Start the countdown
			context.isRunning = true;

			const intervalId = setInterval( () => {

				if ( context.timeRemaining > 0 ) {
					context.timeRemaining -= 1;
				} else {
					// Timer finished
					context.isRunning = false;
					context.isFinished = true;
					clearInterval( intervalId );
					timers.delete( blockId );
				}
			}, 1000 );

			// Store the interval ID
			timers.set( blockId, intervalId );
		},

		/**
		 * Format time as MM:SS
		 */
		formatTime: () => {
			const context = getContext();
			const seconds = context.timeRemaining;
			const mins = Math.floor( seconds / 60 );
			const secs = seconds % 60;
			return `${ String( mins ).padStart( 2, '0' ) }:${ String(
				secs
			).padStart( 2, '0' ) }`;
		},
	},
} );
