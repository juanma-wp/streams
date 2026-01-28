<?php

/**
 * Integration test class for testing the WordPress admin UI functionality.
 * 
 * This test class verifies that our plugin's admin interface is properly
 * integrated into the WordPress admin panel. It extends WP_UnitTestCase to
 * have access to WordPress test framework utilities and database handling.
 * 
 * The tests in this class specifically focus on:
 * - Proper registration of admin menu items
 * - Settings page integration under the WordPress Settings menu
 * - Admin UI capability checks and permissions
 */
class QRT_Admin_UITest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Ensure an administrator is set so capability checks pass when building menus
        // other role options: editor, author, contributor, subscriber
        $admin_id = self::factory()->user->create(['role' => 'administrator']);

        // global $wpdb;

        // $cnt = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->users}");
        // $u   =       $wpdb->get_row("SELECT ID, user_login FROM {$wpdb->users} WHERE ID = {$admin_id}", ARRAY_A);
        // $meta =       $wpdb->get_results("SELECT meta_key, meta_value FROM {$wpdb->usermeta} WHERE user_id = {$admin_id} LIMIT 10", ARRAY_A);
        // $auto =       $wpdb->get_var("SELECT @@session.autocommit");
        // $db  =       $wpdb->get_var("SELECT DATABASE()");
        // $host =       $wpdb->get_var("SELECT @@hostname");
        // $port =       $wpdb->get_var("SELECT @@port");


        wp_set_current_user($admin_id);
        // Build the admin menu so $submenu is populated
        do_action('admin_menu');
    }


    public function test_settings_page_is_registered()
    {
        global $submenu;

        // Options menu slug is 'options-general.php'
        $this->assertIsArray($submenu, 'Global $submenu was not initialized as an array');
        $this->assertArrayHasKey('options-general.php', $submenu);
        $found = false;
        foreach ($submenu['options-general.php'] as $item) {
            if (isset($item[2]) && $item[2] === 'qrt-settings') {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, 'Settings page slug qrt-settings not found under Settings menu');
    }
}
