<?php
/**
 * JuanMa DevRel Theme Functions
 *
 * @package JuanMa_DevRel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue theme styles and scripts
 */
function juanma_devrel_enqueue_assets() {
	// Enqueue custom theme styles
	wp_enqueue_style(
		'juanma-devrel-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Enqueue custom CSS for animations and enhancements
	wp_add_inline_style(
		'juanma-devrel-style',
		'
		@keyframes ping {
			75%, 100% {
				transform: scale(2);
				opacity: 0;
			}
		}

		.has-backdrop-blur {
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
		}

		/* Smooth transitions for cards */
		.wp-block-group[class*="border"] {
			transition: border-color 0.2s ease-in-out;
		}

		/* Selection colors */
		::selection {
			background-color: #f4f4f5;
			color: #18181b;
		}

		/* Smooth scroll */
		html {
			scroll-behavior: smooth;
		}

		/* Font smoothing */
		body {
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}

		/* Enhanced link hover states */
		a {
			transition: color 0.2s ease-in-out;
		}

		/* Navigation link styles */
		.wp-block-navigation__container a {
			color: #71717a;
			transition: color 0.2s ease-in-out;
		}

		.wp-block-navigation__container a:hover {
			color: #18181b;
		}

		/* Social links hover effect */
		.wp-block-social-links .wp-block-social-link {
			transition: all 0.2s ease-in-out;
		}

		.wp-block-social-links .wp-block-social-link:hover {
			background-color: #f4f4f5 !important;
		}

		.wp-block-social-links .wp-block-social-link:hover a {
			color: #18181b !important;
		}

		/* Card hover effects */
		.wp-block-group:has(.has-white-background-color):hover {
			border-color: #a1a1aa !important;
		}

		/* Button hover states */
		button, .wp-block-button__link {
			transition: all 0.2s ease-in-out;
		}

		/* Form input styles */
		input[type="email"]:focus {
			border-color: #a1a1aa !important;
			outline: none;
			box-shadow: 0 0 0 1px #a1a1aa;
		}

		/* Responsive adjustments */
		@media (max-width: 768px) {
			h1 {
				font-size: 2.25rem !important;
			}

			.wp-block-columns {
				flex-direction: column;
			}

			.wp-block-column {
				flex-basis: 100% !important;
			}
		}
		'
	);
}
add_action( 'wp_enqueue_scripts', 'juanma_devrel_enqueue_assets' );

/**
 * Add Google Fonts
 */
function juanma_devrel_enqueue_fonts() {
	wp_enqueue_style(
		'juanma-devrel-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap',
		array(),
		null
	);
}
add_action( 'wp_enqueue_scripts', 'juanma_devrel_enqueue_fonts' );
