<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateWorkoutSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;

final class WorkoutAbstractDataModelFactory implements AbstractDataModelFactory
{
    public function buildNewDataModel(CreateWorkoutSourceModel|SourceModelInterface $source): WorkoutDataModel
    {
        $workout = new WorkoutDataModel();
        $workout->name = $source->name;
        $workout->status = $source->status ?? $workout->status;
        $workout->visibility = $source->visibility ?? $workout->visibility;

        return $workout;
    }
}