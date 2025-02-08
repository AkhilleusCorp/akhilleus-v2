<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class UpdateMovementSourceModel implements UpdateSourceModelInterface
{
    public string $name;
    public string $status;

    public bool $hasReps = false;
    public bool $hasWeight = false;
    public bool $hasDuration = false;
    public bool $hasDistance = false;

    public int $primaryMuscle;
    /** @var int[]|null */
    public ?array $auxiliaryMuscles;
    /** @var int[]|null */
    public ?array $equipments;
}
