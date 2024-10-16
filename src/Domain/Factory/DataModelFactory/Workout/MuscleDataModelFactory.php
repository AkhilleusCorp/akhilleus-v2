<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateMuscleSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;

class MuscleDataModelFactory extends AbstractDataModelFactory
{
    /**
     * @param CreateMuscleSourceModel $source
     */
    public function buildNewDataModel(CreateSourceModelInterface $source): MuscleDataModel
    {
        $muscle = new MuscleDataModel();
        $muscle->name = $source->name;

        return $muscle;
    }
}
