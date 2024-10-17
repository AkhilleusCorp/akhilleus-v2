<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;

final class CreateMovementSourceModel implements CreateSourceModelInterface
{
    public string $name;
    public string $status;
    public int $primaryMuscle;
    /** @var int[]|null */
    public ?array $auxiliaryMuscles = null;
    /** @var int[]|null */
    public ?array $equipments = null;
}
