<?php

namespace App\Domain\DTO\FilterModel\Equipment;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;

final class GetManyEquipmentsFilterModel extends AbstractFilterModel implements FilterModelInterface
{
    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    /** @var string[] */
    public array $status = [];
}
