<?php

namespace App\Domain\DTO\FilterModel\Workout;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;

final class GetManyMusclesFilterModel extends AbstractFilterModel implements FilterModelInterface
{
    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $name = null;

    /** @var string[] */
    public array $status = [];
}
