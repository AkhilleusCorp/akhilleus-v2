<?php

namespace App\Tests\units\Domain\DataTransformer;

use App\Domain\DataTransformer\WorkoutStatusDataTransformer;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use PHPUnit\Framework\TestCase;
final class WorkoutStatusDataTransformerTest extends TestCase
{
    public function testComputeStatusUnknownState(): void
    {
        $this->expectException(\LogicException::class);

        WorkoutStatusDataTransformer::computeStatus(new WorkoutDataModel());
    }

    public function testComputeStatusInProgress(): void
    {
        $workout = new WorkoutDataModel();
        $workout->startDate = new \DateTimeImmutable();

        $status = WorkoutStatusDataTransformer::computeStatus($workout);

        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $status);
    }

    public function testComputeStatusInProgressWithPlannedDate(): void
    {
        $workout = new WorkoutDataModel();
        $workout->plannedDate = new \DateTimeImmutable('1hour ago');
        $workout->startDate = new \DateTimeImmutable();

        $status = WorkoutStatusDataTransformer::computeStatus($workout);

        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $status);
    }

    public function testComputeStatusCompleted(): void
    {
        $workout = new WorkoutDataModel();
        $workout->startDate = new \DateTimeImmutable('1hour ago');
        $workout->endDate = new \DateTimeImmutable();

        $status = WorkoutStatusDataTransformer::computeStatus($workout);

        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED, $status);
    }

    public function testComputeStatusCompletedWithPlannedDate(): void
    {
        $workout = new WorkoutDataModel();
        $workout->plannedDate = new \DateTimeImmutable('1hour ago');
        $workout->startDate = new \DateTimeImmutable('1hour ago');
        $workout->endDate = new \DateTimeImmutable();

        $status = WorkoutStatusDataTransformer::computeStatus($workout);

        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED, $status);
    }

    public function testComputeStatusPlanned(): void
    {
        $workout = new WorkoutDataModel();
        $workout->plannedDate = new \DateTimeImmutable('1day');

        $status = WorkoutStatusDataTransformer::computeStatus($workout);

        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED, $status);
    }
}