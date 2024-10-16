<?php

namespace App\Domain\Factory\SourceModelFactory\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\UpdateMovementSourceModel;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class UpdateMovementSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    /**
     * @param array<mixed> $parameters
     *
     * @return UpdateMovementSourceModel
     */
    public function buildSourceModel(array $parameters): SourceModelInterface
    {
        $sourceModel = new UpdateMovementSourceModel();
        $this->inferSourceModel($parameters, $sourceModel);

        return $sourceModel;
    }
}
