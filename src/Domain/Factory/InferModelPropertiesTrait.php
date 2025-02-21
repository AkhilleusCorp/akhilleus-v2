<?php

namespace App\Domain\Factory;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;

trait InferModelPropertiesTrait
{
    /**
     * @param array<mixed> $parameters
     */
    private function inferFromParameters(array $parameters, SourceModelInterface|FilterModelInterface $model): void
    {
        foreach ($parameters as $key => $value) {
            if (property_exists($model, $key)) {
                $model->{$key} = $value;
            }
        }
    }
}
