<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractMovementSourceModel
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\Choice(choices: WorkoutStatusRegistry::WORKOUT_STATUSES)]
    public string $status;

    #[Assert\NotNull()]
    public bool $hasReps = false;
    #[Assert\NotNull()]
    public bool $hasWeight = false;
    #[Assert\NotNull()]
    public bool $hasDuration = false;
    #[Assert\NotNull()]
    public bool $hasDistance = false;
    #[Assert\NotNull()]
    public bool $hasSpeed = false;

    #[Assert\GreaterThan(value: 0)]
    public int $primaryMuscle;

    /** @var int[]|null */
    public ?array $auxiliaryMuscles = null;
    /** @var int[]|null */
    public ?array $equipments = null;
}
