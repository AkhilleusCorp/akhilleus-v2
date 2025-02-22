<?php

namespace App\Domain\DTO\FilterModel\Equipment;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Registry\Equipment\EquipmentStatusRegistry;
use App\Infrastructure\ApiDoc;

final class GetManyEquipmentsFilterModel extends AbstractFilterModel implements FilterModelInterface
{
    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    /** @var string[] */
    #[ApiDoc\Parameter(enum: EquipmentStatusRegistry::EQUIPMENT_STATUSES)]
    public array $status = [];
}
