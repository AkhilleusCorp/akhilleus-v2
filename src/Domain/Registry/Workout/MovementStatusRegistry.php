<?php

namespace App\Domain\Registry\Workout;

interface MovementStatusRegistry
{
    public const MOVEMENT_STATUS_ACTIVE = 'active';
    public const MOVEMENT_STATUS_DRAFT = 'draft';
    public const MOVEMENT_STATUS_DEACTIVATED = 'deactivated';

    public const MOVEMENT_STATUSES = [
        self::MOVEMENT_STATUS_ACTIVE,
        self::MOVEMENT_STATUS_DRAFT,
        self::MOVEMENT_STATUS_DEACTIVATED,
    ];
}
