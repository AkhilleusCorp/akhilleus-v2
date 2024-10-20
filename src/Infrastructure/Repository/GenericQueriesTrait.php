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

    /**
     * @return array{id: int, label: string}
     */
    public function getDropdownable(string $labelProperty): array
    {
        $query = $this->getEntityManager()->createQuery(
            "select d.id, d.{$labelProperty} as label from {$this->getEntityName()} as d where d.status = 'active'"
        );

        return $query->getArrayResult();
    }
}
