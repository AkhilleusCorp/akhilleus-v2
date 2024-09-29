<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\SourceModelInterface;

final class GenericSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    public function buildSourceModel(array $parameters, ?SourceModelInterface $sourceModel = null): SourceModelInterface
    {
        return $this->inferSourceModel($parameters, $sourceModel);
    }
}