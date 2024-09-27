<?php

namespace App\Domain\Factory\FilterModelFactory;

use App\Domain\DTO\FilterModel\FilterModelInterface;

final class GenericFilterModelFactory extends AbstractFilterModelFactory
{
    public function buildGetManyFilterModel(array $parameters, FilterModelInterface $filter): FilterModelInterface
    {
        return $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            $filter
        );
    }
}