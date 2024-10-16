<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class GenericSourceModelFactory implements GenericSourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    /**
     * @param array<mixed> $parameters
     *
     * @return CreateSourceModelInterface|UpdateSourceModelInterface|SourceModelInterface
     */
    public function buildGenericSourceModel(array $parameters, SourceModelInterface $sourceModel): SourceModelInterface
    {
        $this->inferSourceModel($parameters, $sourceModel);

        return $sourceModel;
    }
}
