<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\SourceModelInterface;

trait InferSourceModelFactoryTrait
{
    protected function inferSourceModel(array $parameters, SourceModelInterface $source): SourceModelInterface
    {
        foreach ($parameters as $key => $value) {
            if (property_exists($source, $key)) {
                $source->{$key} = $value;
            }
        }

        return $source;
    }
}