<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;

final class CreateWorkoutSourceModel implements SourceModelInterface
{
    public string $name;
    public ?string $status = null;
    public ?string $visibility = null;
}