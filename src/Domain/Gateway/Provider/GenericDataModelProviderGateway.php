<?php

namespace App\Domain\Gateway\Provider;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use Doctrine\ORM\QueryBuilder;

interface GenericDataModelProviderGateway
{
    public function getOneById(int $id): ?DataModelInterface;

    public function getByFilterModel(FilterModelInterface $filter): QueryBuilder;
    public function getByArrayParameters(array $parameters): array;

    public function countByFilterModel(?FilterModelInterface $filter): int;
}