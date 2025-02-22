<?php

namespace App\Domain\DTO\FilterModel\Workout;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Registry\Workout\MovementStatusRegistry;
use App\Infrastructure\ApiDoc;

final class GetManyMovementsFilterModel extends AbstractFilterModel implements FilterModelInterface
{
    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    public ?string $muscleId = null;

    public ?string $equipmentId = null;

    /** @var string[] */
    #[ApiDoc\Parameter(enum: MovementStatusRegistry::MOVEMENT_STATUSES)]
    public array $status = [];
}
