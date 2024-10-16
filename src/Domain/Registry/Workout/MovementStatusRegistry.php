<?php

namespace App\Domain\Registry\Workout;

interface MovementStatusRegistry
{
    public const MOVEMENT_STATUS_ACTIVE = 'active';
    public const MOVEMENT_STATUS_DRAFT = 'draft';
    public const MOVEMENT_STATUS_DEACTIVATED = 'deactivated';
}
