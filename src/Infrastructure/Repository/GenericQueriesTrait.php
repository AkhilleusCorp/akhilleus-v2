<?php

namespace App\Infrastructure\Repository;

use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;

trait GenericQueriesTrait
{
    public function getOneById(int $id): ?EquipmentDataModel
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }
}