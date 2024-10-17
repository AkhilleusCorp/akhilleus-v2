<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;

final class CreateExerciseGroupSourceModel implements CreateSourceModelInterface
{
    public int $workoutId;

    /** @var int[] */
    public array $movementIds;
}
