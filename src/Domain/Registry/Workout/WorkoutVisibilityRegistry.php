<?php

namespace App\Domain\Registry\Workout;

interface WorkoutVisibilityRegistry
{
    public const WORKOUT_VISIBILITY_PRIVATE = 'private';
    public const WORKOUT_VISIBILITY_PUBLIC = 'public';
    public const WORKOUT_VISIBILITY_FRIENDS = 'friends';
    public const WORKOUT_VISIBILITY_FOLLOWERS = 'followers';
    public const WORKOUT_VISIBILITY_SPECIFIC_CLIENT = 'specific-client';
    public const WORKOUT_VISIBILITY_ALL_CLIENT = 'all-clients';

    public const WORKOUT_VISIBILITIES = [
        self::WORKOUT_VISIBILITY_PRIVATE,
        self::WORKOUT_VISIBILITY_PUBLIC,
        self::WORKOUT_VISIBILITY_FRIENDS,
        self::WORKOUT_VISIBILITY_FOLLOWERS,
        self::WORKOUT_VISIBILITY_SPECIFIC_CLIENT,
        self::WORKOUT_VISIBILITY_ALL_CLIENT,
    ];
}
