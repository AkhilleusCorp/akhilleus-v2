<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;

final class CreateMuscleSourceModel implements CreateSourceModelInterface
{
    public string $name;
    public string $status;
}
