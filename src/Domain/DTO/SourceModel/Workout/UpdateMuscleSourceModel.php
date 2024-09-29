<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;

final class UpdateMuscleSourceModel implements SourceModelInterface
{
    public string $name;
}