<?php

namespace App\Infrastructure\Repository;

use Doctrine\ORM\QueryBuilder;

trait CommonWhereFilterTrait
{
    protected function filterByIds(QueryBuilder $queryBuilder, ?array $ids): void
    {
        if (false === empty($ids)) {
            $queryBuilder->andWhere($this->getAlias().'.id IN (:ids)')
                ->setParameter('ids', $ids);
        }
    }

    protected function filterByName(QueryBuilder $queryBuilder, ?string $name): void
    {
        if (false === empty($name)) {
            $queryBuilder->andWhere($this->getAlias().'.name LIKE :name')
                ->setParameter('name', '%' . $name . '%');
        }
    }

    protected function filterByStatus(QueryBuilder $queryBuilder, ?array $status = []): void
    {
        if (false === empty($status)) {
            $queryBuilder->andWhere($this->getAlias().'.status IN (:status)')
                ->setParameter('status', $status);
        }
    }

    protected function filterByType(QueryBuilder $queryBuilder, ?string $type): void
    {
        if (false === empty($type)) {
            $queryBuilder->andWhere($this->getAlias().'.type = :type')
                ->setParameter('type', $type);
        }
    }
}