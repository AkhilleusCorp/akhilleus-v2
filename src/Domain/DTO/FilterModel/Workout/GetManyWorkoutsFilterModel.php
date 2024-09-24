<?php

namespace App\Domain\DTO\FilterModel\Workout;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\PaginationFilterTrait;
use App\Domain\DTO\FilterModel\SortsFilterTrait;

final class GetManyWorkoutsFilterModel implements FilterModelInterface
{
    use PaginationFilterTrait;
    use SortsFilterTrait;

    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    /** @var string[]|null  */
    public ?array $statuses = null;
}