<?php

class QRT_Admin_UITest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Ensure an administrator is set so capability checks pass when building menus
        $admin_id = self::factory()->user->create(['role' => 'administrator']);
        wp_set_current_user($admin_id);
        // Build the admin menu so $submenu is populated
        do_action('admin_menu');
    }

    public function test_settings_page_is_registered()
    {
        global $submenu;
        // Ensure the admin menu is generated (setUp already does this)
        do_action('admin_menu');
        // Options menu slug is 'options-general.php'
        // Debug logging removed to avoid output during tests (affects headers)
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
