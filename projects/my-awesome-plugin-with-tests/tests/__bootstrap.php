<?php

/**
 * PHPUnit bootstrap file for plugin testing.
 * This file is automatically executed by PHPUnit before running any tests.
 */

// Load Composer autoloader - resolves to /var/www/html/wp-content/plugins/your-plugin/vendor/autoload.php in wp-env
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

// wp-env automatically sets WP_TESTS_DIR to /tmp/wordpress-tests-lib/ within the container
$_tests_dir = getenv('WP_TESTS_DIR');

// Fallback for non-wp-env environments
if (! $_tests_dir) {
    $_tests_dir = rtrim(sys_get_temp_dir(), '/\\') . '/wordpress-tests-lib';
}

// Verify WordPress test framework is installed (wp-env handles this automatically)
if (! file_exists($_tests_dir . '/includes/functions.php')) {
    echo "Could not find $_tests_dir/includes/functions.php\n";
    echo "Please ensure WordPress test suite is installed.\n";
    exit(1);
}

// Load WordPress testing utilities (tests_add_filter, factory classes, etc.)
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 * Path resolves to /var/www/html/wp-content/plugins/your-plugin/your-plugin-file.php
 */
function _manually_load_plugin()
{
    // Replace 'your-plugin-file.php' with your actual plugin's main file
    require dirname(dirname(__FILE__)) . '/your-plugin-file.php';
}

// Load plugin during WordPress initialization
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

// Initialize complete WordPress testing environment with database and core functions
require $_tests_dir . '/includes/bootstrap.php';
