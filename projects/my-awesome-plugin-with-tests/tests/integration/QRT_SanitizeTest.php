<?php

class QRT_SanitizeTest extends WP_UnitTestCase
{
    public function test_qrt_sanitize_wpm_with_positive_integer()
    {
        $this->assertSame(250, qrt_sanitize_wpm(250));
    }

    public function test_qrt_sanitize_wpm_with_zero_returns_default()
    {
        $this->assertSame(200, qrt_sanitize_wpm(0));
    }

    public function test_qrt_sanitize_wpm_with_negative_returns_default()
    {
        $this->assertSame(200, qrt_sanitize_wpm(-5));
    }

    public function test_qrt_sanitize_wpm_with_non_numeric_returns_default()
    {
        $this->assertSame(200, qrt_sanitize_wpm('abc'));
    }
}
