<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;

interface ExerciseGroupDataModelProviderGateway
{
    public function getExerciseGroupById(int $groupId): ?ExerciseGroupDataModel;

    /**
     * @return ExerciseGroupDataModel[]
     */
    public function getManyAllGroupsByWorkout(int $workoutId): array;
}
