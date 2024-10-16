<?php

namespace App\Domain\Factory\SourceModelFactory\User;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class CreateUserSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    /**
     * @param array<mixed> $parameters
     *
     * @return CreateUserSourceModel
     */
    public function buildSourceModel(array $parameters): SourceModelInterface
    {
        $sourceModel = new CreateUserSourceModel();
        $this->inferSourceModel($parameters, $sourceModel);

        return $sourceModel;
    }
}
