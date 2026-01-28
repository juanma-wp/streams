<?php

class QRT_ReadingTimeTest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        delete_option('qrt_wpm');
        update_option('qrt_wpm', 200);
    }

    public function tearDown(): void
    {
        delete_option('qrt_wpm');
        parent::tearDown();
    }

    public function test_reading_time_calculation_basic()
    {
        $content = str_repeat('word ', 200);

        $post_id = $this->factory()->post->create([
            'post_content' => $content,
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        the_post();
        $result = qrt_add_reading_time(get_the_content());

        $this->assertStringContainsString('1 min read', $result);
        $this->assertStringContainsString('qrt-badge', $result);
    }

    public function test_reading_time_calculation_multiple_minutes()
    {
        update_option('qrt_wpm', 100);
        $content = str_repeat('word ', 500);

        $post_id = $this->factory()->post->create([
            'post_content' => $content,
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        the_post();
        $result = qrt_add_reading_time(get_the_content());

        $this->assertStringContainsString('5 mins read', $result);
    }

    public function test_reading_time_with_html_content()
    {
        $content = '<p>' . str_repeat('word ', 200) . '</p><strong>bold text</strong>';

        $post_id = $this->factory()->post->create([
            'post_content' => $content,
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        the_post();
        $result = qrt_add_reading_time(get_the_content());

        $this->assertStringContainsString('2 mins read', $result);
    }

    public function test_reading_time_minimum_one_minute()
    {
        $content = 'just a few words';

        $post_id = $this->factory()->post->create([
            'post_content' => $content,
            'post_type' => 'post'
        ]);

        $this->go_to(get_permalink($post_id));

        the_post();
        $result = qrt_add_reading_time(get_the_content());

        $this->assertStringContainsString('1 min read', $result);
    }

    public function test_reading_time_not_added_outside_loop()
    {
        $content = 'test content';

        $result = qrt_add_reading_time($content);

        $this->assertEquals($content, $result);
    }
}
