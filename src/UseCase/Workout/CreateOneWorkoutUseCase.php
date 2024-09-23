<?php

namespace App\UseCase\Workout;

use App\Infrastructure\Registry\DataProfileRegistry;
use App\UseCase\UseCaseInterface;

final class CreateOneWorkoutUseCase implements UseCaseInterface
{
    public function execute(array $parameters, string $dateProfile = DataProfileRegistry::DATA_PROFILE_MEMBER)
    {

    }
}