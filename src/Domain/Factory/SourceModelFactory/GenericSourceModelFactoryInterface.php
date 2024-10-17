<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\SourceModelInterface;

interface GenericSourceModelFactoryInterface
{
    /**
     * @param array<mixed> $parameters
     */
    public function buildGenericSourceModel(array $parameters, SourceModelInterface $sourceModel): SourceModelInterface;
}
