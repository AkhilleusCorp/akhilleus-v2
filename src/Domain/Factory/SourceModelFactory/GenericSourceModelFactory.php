<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class GenericSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    public function buildSourceModel(array $parameters, ?SourceModelInterface $sourceModel = null): CreateSourceModelInterface|UpdateSourceModelInterface
    {
        return $this->inferSourceModel($parameters, $sourceModel);
    }
}