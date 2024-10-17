<?php

namespace App\Domain\Registry\Workout;

interface WorkoutStatusRegistry
{
    public const WORKOUT_STATUS_PLANNED = 'planned';
    public const WORKOUT_STATUS_IN_PROGRESS = 'in-progress';
    public const WORKOUT_STATUS_COMPLETED = 'completed';
    public const WORKOUT_STATUSES = [
        self::WORKOUT_STATUS_PLANNED,
        self::WORKOUT_STATUS_IN_PROGRESS,
        self::WORKOUT_STATUS_COMPLETED,
    ];
}
