<?php

namespace App\Domain\Registry\Workout;

interface MuscleStatusRegistry
{
    public const MUSCLE_STATUS_ACTIVE = 'active';
    public const MUSCLE_STATUS_DRAFT = 'draft';
    public const MUSCLE_STATUS_DEACTIVATED = 'deactivated';

    public const MUSCLE_STATUSES = [
        self::MUSCLE_STATUS_ACTIVE,
        self::MUSCLE_STATUS_DRAFT,
        self::MUSCLE_STATUS_DEACTIVATED,
    ];
}
