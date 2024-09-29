<?php

namespace App\Domain\Gateway\Provider;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\FilterModel\FilterModelInterface;

interface GenericDataModelProviderGateway
{
    public function getOneById(int $id): ?DataModelInterface;

    /**
     * @return DataModelInterface[]
     */
    public function getByParameters(FilterModelInterface $filter): array;

    public function countByParameters(?FilterModelInterface $filter): int;
}