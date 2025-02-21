<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Domain\Registry\Workout\WorkoutVisibilityRegistry;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractWorkoutSourceModel
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\Choice(choices: WorkoutStatusRegistry::WORKOUT_STATUSES)]
    public string $status;

    #[Assert\Choice(choices: WorkoutVisibilityRegistry::WORKOUT_VISIBILITIES)]
    public string $visibility;
}
