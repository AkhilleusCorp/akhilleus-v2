<?php

namespace App\Domain\Factory\FilterModelFactory;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Factory\InferModelPropertiesTrait;

class FilterModelFactory
{
    use InferModelPropertiesTrait;

    /**
     * @param array<mixed> $parameters
     */
    public function buildFilterFromParameters(array $parameters, FilterModelInterface $filter): FilterModelInterface
    {
        $this->inferFromParameters($parameters, $filter);

        return $filter;
    }
}
