<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;

final class CreateMovementSourceModel implements CreateSourceModelInterface
{
    public string $name;
    public int $primaryMuscle;
    public ?array $auxiliaryMuscles = null;
    public ?array $equipments = null;
}