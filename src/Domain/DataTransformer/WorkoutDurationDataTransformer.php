<?php

namespace App\Domain\DataTransformer;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;

final class WorkoutDurationDataTransformer
{
    public static function computeDurationInSeconds(WorkoutDataModel $workout): ?int
    {
        if (null === $workout->startDate || null === $workout->endDate) {
            return null;
        }

        return $workout->endDate->getTimestamp() - $workout->startDate->getTimestamp();
    }
}
