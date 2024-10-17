<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;

final class CreateWorkoutSourceModel implements CreateSourceModelInterface
{
    public string $name;
    public ?string $status = null;
    public ?string $visibility = null;
}
