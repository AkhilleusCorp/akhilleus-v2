<?php

namespace App\Tests\units\Infrastructure\DataTransformer;

use App\Infrastructure\DataTransformer\DateDataTransformer;
use PHPUnit\Framework\TestCase;

final class DateDataTransformerTest extends TestCase
{
    public function testToStringFormatSWithNullDate(): void
    {
        $result = DateDataTransformer::toStringFormat(null);

        $this->assertNull($result);
    }

    public function testToStringFormatShortVersion(): void
    {
        $result = DateDataTransformer::toStringFormat(new \DateTimeImmutable('2024-01-26 20:00:00'), true);

        $this->assertEquals('2024-01-26', $result);
    }

    public function testToStringFormatLongVersion(): void
    {
        $result = DateDataTransformer::toStringFormat(new \DateTimeImmutable('2024-01-26 20:00:00'));

        $this->assertEquals('2024-01-26 20:00:00', $result);
    }
}
