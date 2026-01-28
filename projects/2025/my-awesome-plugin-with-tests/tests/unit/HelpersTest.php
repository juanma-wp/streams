<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function WPCOM\MyFirstPlugin\Helpers\calculate_reading_time;

final class HelpersTest extends TestCase
{
    public function test_calculate_reading_time(): void
    {
        $this->assertEquals(1, calculate_reading_time('Hello', 100));
        $this->assertEquals(2, calculate_reading_time(str_repeat('Hello ', 200), 100));
        $this->assertEquals(10, calculate_reading_time(str_repeat('Hello ', 1000), 100));
    }
}
