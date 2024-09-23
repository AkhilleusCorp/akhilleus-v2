<?php

namespace App\UseCase\Workout;

use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\UseCase\UseCaseInterface;

final class GetManyWorkoutUseCase implements UseCaseInterface
{
    public function execute(array $parameters, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): MultipleObjectViewModel
    {

    }
}