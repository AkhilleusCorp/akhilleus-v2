<?php

namespace App\Domain\Factory\SourceModelFactory\Workout;

use App\Domain\DTO\SourceModel\Workout\CreateWorkoutSourceModel;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class CreateWorkoutSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    public function buildSourceModel(array $parameters, ?SourceModelInterface $sourceModel = null): CreateWorkoutSourceModel|SourceModelInterface
    {
        return $this->inferSourceModel($parameters, new CreateWorkoutSourceModel());
    }
}