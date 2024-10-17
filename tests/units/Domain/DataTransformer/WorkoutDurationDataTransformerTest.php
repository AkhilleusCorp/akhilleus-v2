<?php

namespace App\Tests\units\Domain\DataTransformer;

use App\Domain\DataTransformer\WorkoutDurationDataTransformer;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use PHPUnit\Framework\TestCase;

final class WorkoutDurationDataTransformerTest extends TestCase
{
    public function testComputeDurationInSecondsWithoutStartDate(): void
    {
        $workout = new WorkoutDataModel();
        $workout->endDate = new \DateTimeImmutable();

        $result = WorkoutDurationDataTransformer::computeDurationInSeconds($workout);

        $this->assertNull($result);
    }

    public function testComputeDurationInSecondsWithoutEndDate(): void
    {
        $workout = new WorkoutDataModel();
        $workout->startDate = new \DateTimeImmutable();

        $result = WorkoutDurationDataTransformer::computeDurationInSeconds($workout);

        $this->assertNull($result);
    }

    public function testComputeDurationInSecondsWithoutStartOrEndDate(): void
    {
        $workout = new WorkoutDataModel();

        $result = WorkoutDurationDataTransformer::computeDurationInSeconds($workout);

        $this->assertNull($result);
    }

    public function testComputeDurationInSeconds(): void
    {
        $workout = new WorkoutDataModel();
        $workout->startDate = new \DateTimeImmutable('2024-01-26 20:00:00');
        $workout->endDate = new \DateTimeImmutable('2024-01-26 20:30:00');

        $result = WorkoutDurationDataTransformer::computeDurationInSeconds($workout);

        $this->assertEquals(1800, $result);

        $workout = new WorkoutDataModel();
        $workout->startDate = new \DateTimeImmutable('2024-01-26 20:04:00');
        $workout->endDate = new \DateTimeImmutable('2024-01-26 21:22:00');

        $result = WorkoutDurationDataTransformer::computeDurationInSeconds($workout);

        $this->assertEquals(4680, $result);
    }
}
