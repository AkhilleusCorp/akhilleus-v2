<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseDataModel;

interface ExerciseDataModelProviderGateway
{
    public function getExerciseById(int $exerciseId): ?ExerciseDataModel;
}