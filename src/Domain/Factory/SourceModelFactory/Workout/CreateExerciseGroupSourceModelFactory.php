<?php

namespace App\Domain\Factory\SourceModelFactory\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateExerciseGroupSourceModel;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class CreateExerciseGroupSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    public function buildSourceModel(array $parameters, ?SourceModelInterface $sourceModel = null): CreateExerciseGroupSourceModel|SourceModelInterface
    {
        return $this->inferSourceModel($parameters, new CreateExerciseGroupSourceModel());
    }
}