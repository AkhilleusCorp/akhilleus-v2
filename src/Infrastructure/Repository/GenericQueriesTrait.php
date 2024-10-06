<?php

namespace App\Infrastructure\Repository;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\ORM\Query\QueryException;

trait GenericQueriesTrait
{
    public function getOneById(int $id): ?DataModelInterface
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }

    public function getDropdownable(string $labelProperty): array
    {
        try {
            $query = $this->getEntityManager()->createQuery("select d.id, d.{$labelProperty} from {$this->getEntityName()} as d");

            return $query->getArrayResult();
        } catch (QueryException $exception) { // This exception is actually thrown if property doesn't exist
            throw new \LogicException("$labelProperty doesn't exist on this object");
        }

    }
}