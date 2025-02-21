<?php

namespace App\Domain\Registry\Equipment;

interface EquipmentStatusRegistry
{
    public const EQUIPMENT_STATUS_ACTIVE = 'active';
    public const EQUIPMENT_STATUS_DRAFT = 'draft';
    public const EQUIPMENT_STATUS_DEACTIVATED = 'deactivated';

    public const EQUIPMENT_STATUSES = [
        self::EQUIPMENT_STATUS_ACTIVE,
        self::EQUIPMENT_STATUS_DRAFT,
        self::EQUIPMENT_STATUS_DEACTIVATED,
    ];
}
