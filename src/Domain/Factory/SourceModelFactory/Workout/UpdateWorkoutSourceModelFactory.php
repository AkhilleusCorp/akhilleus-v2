<?php

namespace App\Domain\Factory\SourceModelFactory\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\UpdateWorkoutSourceModel;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class UpdateWorkoutSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    /**
     * @param array<mixed> $parameters
     *
     * @return UpdateWorkoutSourceModel
     */
    public function buildSourceModel(array $parameters): SourceModelInterface
    {
        $sourceModel = new UpdateWorkoutSourceModel();
        $this->inferSourceModel($parameters, $sourceModel);

        return $sourceModel;
    }
}
