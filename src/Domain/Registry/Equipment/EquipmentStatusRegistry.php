<?php

namespace App\Domain\Registry\Equipment;

interface EquipmentStatusRegistry
{
    public const EQUIPMENT_STATUS_ACTIVE = 'active';
    public const EQUIPMENT_STATUS_DRAFT = 'draft';
    public const EQUIPMENT_STATUS_DEACTIVATED = 'deactivated';
}