<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\SourceModelInterface;

interface SourceModelFactoryInterface
{
    /**
     * @param array<mixed> $parameters
     */
    public function buildSourceModel(array $parameters): SourceModelInterface;
}
