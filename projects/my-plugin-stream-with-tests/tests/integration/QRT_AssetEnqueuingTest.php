<?php

class QRT_AssetEnqueuingTest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        global $wp_styles;
        $wp_styles = new WP_Styles();
    }

    /**
     * Get the expected plugin URL
     */
    private function getPluginUrl()
    {
        return plugins_url('', dirname(dirname(__DIR__)) . '/my-plugin-stream-with-tests.php');
    }

    public function test_enqueue_action_is_registered()
    {
        $this->assertIsNumeric(has_action('wp_enqueue_scripts', 'qrt_enqueue_assets'));
    }

    public function test_stylesheet_is_enqueued()
    {
        do_action('wp_enqueue_scripts');

        $this->assertTrue(wp_style_is('qrt-style', 'enqueued'));
    }

    public function test_stylesheet_source()
    {
        do_action('wp_enqueue_scripts');

        global $wp_styles;
        $style_src = $wp_styles->registered['qrt-style']->src;

        $this->assertStringContainsString('style.css', $style_src);
        $this->assertStringContainsString($this->getPluginUrl(), $style_src);
    }

    public function test_stylesheet_version()
    {
        do_action('wp_enqueue_scripts');

        global $wp_styles;
        $style_version = $wp_styles->registered['qrt-style']->ver;

        $this->assertEquals('1.0', $style_version);
    }

    public function test_stylesheet_dependencies()
    {
        do_action('wp_enqueue_scripts');

        global $wp_styles;
        $style_deps = $wp_styles->registered['qrt-style']->deps;

        $this->assertEquals(array(), $style_deps);
    }

    public function test_stylesheet_handle()
    {
        do_action('wp_enqueue_scripts');

        global $wp_styles;

        $this->assertArrayHasKey('qrt-style', $wp_styles->registered);
    }
}
