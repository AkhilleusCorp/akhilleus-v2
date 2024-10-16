<?php

namespace App\Domain\Factory\SourceModelFactory\Workout;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateMovementSourceModel;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class CreateMovementSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    /**
     * @param array<mixed> $parameters
     *
     * @return CreateMovementSourceModel
     */
    public function buildSourceModel(array $parameters): SourceModelInterface
    {
        $sourceModel = new CreateMovementSourceModel();
        $this->inferSourceModel($parameters, $sourceModel);

        return $sourceModel;
    }
}
