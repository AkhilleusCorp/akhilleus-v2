<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class UpdateWorkoutSourceModel implements UpdateSourceModelInterface
{
    public ?string $name;
    public ?string $visibility;
}