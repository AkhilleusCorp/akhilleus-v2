<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;

interface WorkoutDTOProviderGateway
{
    public function getWorkoutById(int $workoutId): ?WorkoutDataModel;

    /**
     * @return WorkoutDataModel[]
     */
    public function getWorkoutsByParameters(GetManyWorkoutsFilterModel $filter): array;

    public function countWorkoutsByParameters(?GetManyWorkoutsFilterModel $filter): int;

}