<?php

class QRT_SanitizationTest extends WP_UnitTestCase
{
    public function test_sanitize_wpm_with_valid_number()
    {
        $result = qrt_sanitize_wpm('250');
        $this->assertEquals(250, $result);
        $this->assertIsInt($result);
    }

    public function test_sanitize_wpm_with_zero()
    {
        $result = qrt_sanitize_wpm('0');
        $this->assertEquals(200, $result);
    }

    public function test_sanitize_wpm_with_negative_number()
    {
        $result = qrt_sanitize_wpm('-50');
        $this->assertEquals(200, $result);
    }

    public function test_sanitize_wpm_with_string()
    {
        $result = qrt_sanitize_wpm('invalid');
        $this->assertEquals(200, $result);
    }

    public function test_sanitize_wpm_with_float()
    {
        $result = qrt_sanitize_wpm('250.5');
        $this->assertEquals(250, $result);
        $this->assertIsInt($result);
    }

    public function test_sanitize_wpm_with_empty_string()
    {
        $result = qrt_sanitize_wpm('');
        $this->assertEquals(200, $result);
    }

    public function test_sanitize_wpm_with_null()
    {
        $result = qrt_sanitize_wpm(null);
        $this->assertEquals(200, $result);
    }
}