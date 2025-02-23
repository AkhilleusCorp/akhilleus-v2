<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateExerciseGroupSourceModel implements CreateSourceModelInterface
{
    #[Assert\GreaterThan(0)]
    public int $workoutId;

    public ?int $restDuration = null;

    /** @var int[] */
    public array $movementIds;
}
