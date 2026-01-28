<?php

class QRT_AssetsTest extends WP_UnitTestCase
{
    public function test_style_is_enqueued()
    {
        // Ensure no assets are enqueued yet
        wp_dequeue_style('qrt-style');
        wp_deregister_style('qrt-style');

        // Trigger enqueue hook
        do_action('wp_enqueue_scripts');

        $this->assertTrue(wp_style_is('qrt-style', 'enqueued'));

        $src = wp_styles()->registered['qrt-style']->src ?? '';
        $this->assertStringContainsString('style.css', $src);
    }
}
