<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;

interface ExerciseGroupDataModelProviderGateway
{
    /**
     * @return ExerciseGroupDataModel[]
     */
    public function getManyAllGroupsByWorkout(int $workoutId): array;
}