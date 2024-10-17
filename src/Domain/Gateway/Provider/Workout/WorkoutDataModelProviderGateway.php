<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;

interface WorkoutDataModelProviderGateway
{
    public function getWorkoutById(int $workoutId): ?WorkoutDataModel;

    /**
     * @return WorkoutDataModel[]
     */
    public function getWorkoutsByFilterModel(GetManyWorkoutsFilterModel $filter): array;

    public function countWorkoutsByFilterModel(?GetManyWorkoutsFilterModel $filter): int;
}
