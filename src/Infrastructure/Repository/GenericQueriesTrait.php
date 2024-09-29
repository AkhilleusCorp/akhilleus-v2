<?php

namespace App\Infrastructure\Repository;

use App\Domain\DTO\DataModel\DataModelInterface;

trait GenericQueriesTrait
{
    public function getOneById(int $id): ?DataModelInterface
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }
}