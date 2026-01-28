<?php

class QRT_ContentFilterTest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        delete_option('qrt_wpm');
        update_option('qrt_wpm', 200);

        global $wp_query;
        $wp_query = new WP_Query();
        $wp_query->init();
    }

    public function tearDown(): void
    {
        delete_option('qrt_wpm');
        parent::tearDown();
    }

    public function test_filter_is_registered()
    {
        $this->assertIsNumeric(has_filter('the_content', 'qrt_add_reading_time'));
    }

    public function test_content_filter_integration()
    {
        $post_id = $this->factory()->post->create([
            'post_content' => str_repeat('word ', 200),
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        global $wp_query, $post;
        $post = get_post($post_id);
        $wp_query->in_the_loop = true;
        $wp_query->is_main_query = true;
        $wp_query->is_singular = true;
        $wp_query->queried_object = $post;
        $wp_query->queried_object_id = $post_id;

        $content = get_the_content();
        $filtered_content = apply_filters('the_content', $content);

        $this->assertStringContainsString('qrt-badge', $filtered_content);
        $this->assertStringContainsString('min read', $filtered_content);
    }

    public function test_content_with_shortcodes_stripped()
    {
        $content = '[shortcode]Some content[/shortcode] ' . str_repeat('word ', 100);

        $post_id = $this->factory()->post->create([
            'post_content' => $content,
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        global $wp_query, $post;
        $post = get_post($post_id);
        $wp_query->in_the_loop = true;
        $wp_query->is_main_query = true;
        $wp_query->is_singular = true;

        $filtered_content = apply_filters('the_content', $content);

        $this->assertStringContainsString('qrt-badge', $filtered_content);
        $this->assertStringContainsString('1 min read', $filtered_content);
    }

    public function test_badge_accessibility()
    {
        $content = str_repeat('word ', 200);

        $post_id = $this->factory()->post->create([
            'post_content' => $content,
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        global $wp_query, $post;
        $post = get_post($post_id);
        $wp_query->in_the_loop = true;
        $wp_query->is_main_query = true;
        $wp_query->is_singular = true;

        $filtered_content = apply_filters('the_content', $content);

        $this->assertStringContainsString('aria-label="Estimated reading time"', $filtered_content);
    }

    public function test_badge_positioning()
    {
        $content = 'Original content here';

        $post_id = $this->factory()->post->create([
            'post_content' => $content,
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        global $wp_query, $post;
        $post = get_post($post_id);
        $wp_query->in_the_loop = true;
        $wp_query->is_main_query = true;
        $wp_query->is_singular = true;

        $filtered_content = apply_filters('the_content', $content);

        $this->assertStringStartsWith('<p class="qrt-badge"', $filtered_content);
        $this->assertStringContainsString('Original content here', $filtered_content);
    }
}
