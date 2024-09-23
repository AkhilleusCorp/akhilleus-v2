<?php

namespace App\UseCase\Workout;

use App\Infrastructure\Registry\DataProfileRegistry;
use App\UseCase\UseCaseInterface;

final class UpdateOneWorkoutByIdUseCase implements UseCaseInterface
{
    public function execute(int $id, array $parameters, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER)
    {

    }
}