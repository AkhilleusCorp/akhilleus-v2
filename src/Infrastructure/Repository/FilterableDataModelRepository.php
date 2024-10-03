<?php

namespace App\Infrastructure\Repository;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use Doctrine\ORM\QueryBuilder;

interface FilterableDataModelRepository
{
    public function addParametersFromFilter(QueryBuilder $queryBuilder, FilterModelInterface $filter): self;
}