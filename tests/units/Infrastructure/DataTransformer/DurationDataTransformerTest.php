<?php

namespace App\Tests\units\Infrastructure\DataTransformer;

use App\Infrastructure\DataTransformer\DurationDataTransformer;
use PHPUnit\Framework\TestCase;

final class DurationDataTransformerTest extends TestCase
{
    public function testToHMFormatWithNullDuration(): void
    {
        $result = DurationDataTransformer::toHMFormat(null);

        $this->assertNull($result);
    }

    public function testToHMFormatWithDurationEqualZero(): void
    {
        $result = DurationDataTransformer::toHMFormat(0);

        $this->assertNull($result);
    }

    public function testToHMFormatWithDurationBiggerThanADay(): void
    {
        $this->expectException(\LogicException::class);

        DurationDataTransformer::toHMFormat(900000);
    }

    public function testToHMFormatWithDurationLessThanAMinute(): void
    {
        $this->expectException(\LogicException::class);

        DurationDataTransformer::toHMFormat(36);
    }

    public function testToHMFormatWithDurationLessThanAnHour(): void
    {
        $result = DurationDataTransformer::toHMFormat(666);

        $this->assertEquals('11min', $result);
    }

    public function testToHMFormatWithDurationBiggerThanAnHour(): void
    {
        $result = DurationDataTransformer::toHMFormat(5666);

        $this->assertEquals('1h 34min', $result);
    }
}
