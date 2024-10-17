<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseDataModel;
use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Domain\DTO\DataModel\Workout\MovementDataModel;

final class ExerciseDataModelFactory
{
    public function buildNewDataModel(ExerciseGroupDataModel $group, MovementDataModel $movement): ExerciseDataModel
    {
        $exercise = new ExerciseDataModel();
        $exercise->group = $group;
        $exercise->movement = $movement;

        return $exercise;
    }
}
