<?php

namespace App\Domain\DTO\FilterModel\Workout;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\PaginationFilterTrait;
use App\Domain\DTO\FilterModel\SortsFilterTrait;

final class GetManyMusclesFilterModel implements FilterModelInterface
{
    use PaginationFilterTrait;
    use SortsFilterTrait;

    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    /** @var array string[] */
    public array $status = [];
}