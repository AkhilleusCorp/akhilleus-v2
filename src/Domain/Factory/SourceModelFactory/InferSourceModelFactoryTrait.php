<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\SourceModelInterface;

trait InferSourceModelFactoryTrait
{
    /**
     * @param array<mixed> $parameters
     */
    protected function inferSourceModel(array $parameters, SourceModelInterface $source): void
    {
        foreach ($parameters as $key => $value) {
            if (property_exists($source, $key)) {
                $source->{$key} = $value;
            }
        }
    }
}
