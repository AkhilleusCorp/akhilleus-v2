<?php

namespace App\Domain\Registry\Workout;

interface ExerciseTypeRegistry
{
    public const EXERCISE_TYPE_NORMAL = 'normal';
    public const EXERCISE_TYPE_WARMUP = 'warmup';
    public const EXERCISE_TYPE_DROP = 'drop';
    public const EXERCISE_TYPE_FAILED = 'failed';
    public const EXERCISE_TYPES = [
        self::EXERCISE_TYPE_NORMAL,
        self::EXERCISE_TYPE_WARMUP,
        self::EXERCISE_TYPE_DROP,
        self::EXERCISE_TYPE_FAILED,
    ];
}
