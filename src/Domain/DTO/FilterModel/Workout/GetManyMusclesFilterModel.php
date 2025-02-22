<?php

namespace App\Domain\DTO\FilterModel\Workout;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Registry\Workout\MuscleStatusRegistry;
use App\Infrastructure\ApiDoc;

final class GetManyMusclesFilterModel extends AbstractFilterModel implements FilterModelInterface
{
    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    /** @var string[] */
    #[ApiDoc\Parameter(enum: MuscleStatusRegistry::MUSCLE_STATUSES)]
    public array $status = [];
}
