<?php

class QRT_SettingsTest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        delete_option('qrt_wpm');
    }

    public function tearDown(): void
    {
        delete_option('qrt_wpm');
        parent::tearDown();
    }

    public function test_qrt_register_settings()
    {
        qrt_register_settings();

        global $wp_settings_fields;
        $this->assertArrayHasKey('qrt_settings_group', $wp_settings_fields);
    }

    public function test_default_wpm_value()
    {
        $wpm = get_option('qrt_wpm', 200);
        $this->assertEquals(200, $wpm);
    }

    public function test_wpm_option_registration()
    {
        qrt_register_settings();

        $registered_settings = get_registered_settings();
        $this->assertArrayHasKey('qrt_wpm', $registered_settings);
        $this->assertEquals('integer', $registered_settings['qrt_wpm']['type']);
        $this->assertEquals(200, $registered_settings['qrt_wpm']['default']);
    }
}
