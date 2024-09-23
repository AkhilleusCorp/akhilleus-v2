<?php

namespace App\UseCase\Workout;

use App\Infrastructure\Registry\DataProfileRegistry;
use App\UseCase\UseCaseInterface;

final class GetOneWorkoutByIdUseCase implements UseCaseInterface
{
    public function execute(int $id, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER)
    {

    }
}