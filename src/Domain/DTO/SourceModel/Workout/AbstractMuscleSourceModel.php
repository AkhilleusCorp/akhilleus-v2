<?php

namespace App\Domain\DTO\SourceModel\Workout;

use App\Domain\Registry\Workout\MuscleStatusRegistry;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractMuscleSourceModel
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\Choice(choices: MuscleStatusRegistry::MUSCLE_STATUSES)]
    public string $status;
}
