<?php

namespace App\Domain\DataTransformer;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;

final class WorkoutStatusDataTransformer
{
    public static function computeStatus(WorkoutDataModel $workout): string
    {
        if (null !== $workout->endDate && null !== $workout->startDate) {
            return WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED;
        }

        if (null !== $workout->startDate) {
            return WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS;
        }

        if (null !== $workout->plannedDate) {
            return WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED;
        }

        throw new \LogicException("Workout is in an unknown state.");
    }
}