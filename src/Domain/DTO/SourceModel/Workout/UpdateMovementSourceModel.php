<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class UpdateMovementSourceModel implements UpdateSourceModelInterface
{
    public string $name;

    public string $status;

    public int $primaryMuscle;

    /** @var int[]|null $auxiliaryMuscles */
    public ?array $auxiliaryMuscles;

    /** @var int[]|null $equipments */
    public ?array $equipments;
}