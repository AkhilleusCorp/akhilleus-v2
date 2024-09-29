<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class UpdateMuscleSourceModel implements UpdateSourceModelInterface
{
    public string $name;
}