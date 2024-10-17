<?php

namespace App\Domain\Factory\FilterModelFactory;

use App\Domain\DTO\FilterModel\FilterModelInterface;

final class GenericFilterModelFactory extends AbstractFilterModelFactory
{
    /**
     * @param array<mixed> $parameters
     */
    public function buildGetManyFilterModel(array $parameters, FilterModelInterface $filter): FilterModelInterface
    {
        return $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            $filter
        );
    }
}
