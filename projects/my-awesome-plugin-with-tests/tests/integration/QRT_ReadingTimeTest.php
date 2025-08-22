<?php

class QRT_Reading_TimeTest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Ensure default WPM is set
        update_option('qrt_wpm', 200);
    }

    public function test_adds_badge_on_single_post_main_query()
    {
        $post_id = $this->factory()->post->create([
            'post_content' => str_repeat('word ', 150), // 150 words
        ]);

        // Simulate main query on single post and run within The Loop
        // Note: Avoid query_posts here, as it replaces $wp_query and breaks is_main_query().
        $this->go_to(get_permalink($post_id));

        $content = '';
        // In the loop, we need to get the content from the post
        while (have_posts()) {
            the_post();
            $content = qrt_add_reading_time(get_the_content());
            break;
        }

        $this->assertStringContainsString('qrt-badge', $content);
        $this->assertStringContainsString('min read', $content);
    }

    public function test_does_not_add_badge_outside_main_query()
    {

        // Not in the loop/main query; directly calling filter should return unmodified content
        $filtered = qrt_add_reading_time('Hello');
        $this->assertSame('Hello', $filtered);
    }
}
