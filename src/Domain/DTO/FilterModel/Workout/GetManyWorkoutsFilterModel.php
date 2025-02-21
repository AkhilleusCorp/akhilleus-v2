<?php

namespace App\Domain\DTO\FilterModel\Workout;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Infrastructure\ApiDoc;

final class GetManyWorkoutsFilterModel extends AbstractFilterModel implements FilterModelInterface
{
    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    public ?int $memberId = null;

    /** @var string[] */
    #[ApiDoc\Parameter(enum: WorkoutStatusRegistry::WORKOUT_STATUSES)]
    public array $status = [];
}
