<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateWorkoutSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;

/**
 * @method WorkoutDataModel mergeSourceAndDataModel(DataModelInterface $dataModel, UpdateSourceModelInterface $sourceModel)
 */
final class WorkoutDataModelFactory extends AbstractDataModelFactory
{
    /**
     * @param CreateWorkoutSourceModel $source
     */
    public function buildNewDataModel(CreateSourceModelInterface $source): WorkoutDataModel
    {
        $workout = new WorkoutDataModel();
        $workout->name = $source->name;
        $workout->status = $source->status ?? $workout->status;
        $workout->visibility = $source->visibility ?? $workout->visibility;

        return $workout;
    }
}
