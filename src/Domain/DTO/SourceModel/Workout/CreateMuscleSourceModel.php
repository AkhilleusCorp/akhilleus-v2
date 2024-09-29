<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;

final class CreateMuscleSourceModel implements SourceModelInterface
{
    public string $name;
}