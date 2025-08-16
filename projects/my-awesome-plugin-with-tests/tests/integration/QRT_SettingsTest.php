<?php

class QRT_SettingsTest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Register settings directly without triggering admin_init hooks
        qrt_register_settings();
    }

    public function test_registers_setting_with_expected_args()
    {
        $settings = get_registered_settings();
        $this->assertArrayHasKey('qrt_wpm', $settings);
        $this->assertSame('integer', $settings['qrt_wpm']['type']);
        $this->assertSame('qrt_sanitize_wpm', $settings['qrt_wpm']['sanitize_callback']);
        $this->assertSame(200, $settings['qrt_wpm']['default']);
    }

    public function test_setting_default_is_used_when_not_set()
    {
        delete_option('qrt_wpm');
        $this->assertSame(200, (int) get_option('qrt_wpm', 200));
    }

    public function test_setting_update_respects_sanitization()
    {
        update_option('qrt_wpm', -10);
        $this->assertSame(200, (int) get_option('qrt_wpm'));

        update_option('qrt_wpm', 300);
        $this->assertSame(300, (int) get_option('qrt_wpm'));
    }
}