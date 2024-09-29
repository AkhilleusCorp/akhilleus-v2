<?php

namespace App\Infrastructure\Repository;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Order;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractBaseDataModelRepository extends ServiceEntityRepository
{
    protected abstract function getAlias(): string;

    protected abstract function addParametersFromFilter(QueryBuilder $queryBuilder, FilterModelInterface $filter): self;


    public function getByFilterModel(FilterModelInterface $filter): array
    {
        $queryBuilder = $this->createQueryBuilder($this->getAlias());

        $this->addParametersFromFilter($queryBuilder, $filter)
            ->addPaginationConditions($queryBuilder, $filter)
            ->addSortConditions($queryBuilder, $filter);

        return $queryBuilder->getQuery()->getResult();
    }

    public function countByFilterModel(?FilterModelInterface $filter): int
    {
        $alias = $this->getAlias();
        $queryBuilder = $this->createQueryBuilder($alias)
            ->select("COUNT(DISTINCT {$alias}.id)");

        if (null !== $filter) {
            $this->addParametersFromFilter($queryBuilder, $filter);
        }

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    public function getByArrayParameters(array $parameters): array
    {
        return $this->findBy($parameters);
    }

    protected function addPaginationConditions(QueryBuilder $queryBuilder, FilterModelInterface $filter): self
    {
        if (property_exists($filter, 'limit')) {
            $queryBuilder->setMaxResults($filter->limit);
            $queryBuilder->setFirstResult($filter->limit * ($filter->page - 1));
        }

        return $this;
    }

    protected function addSortConditions(QueryBuilder $queryBuilder, FilterModelInterface $filter): self
    {
        if (property_exists($filter, 'sorts')) {
            foreach ($filter->sorts as $sort) {
                $sortField = $sort;
                $sortDirection = Order::Ascending->value;
                if (str_starts_with($sort, '-')) {
                    $sortField = substr($sort, 1);
                    $sortDirection = Order::Descending->value;
                } elseif (str_starts_with($sort, '+')) {
                    $sortField = substr($sort, 1);
                }

                $queryBuilder->addOrderBy($this->getAlias().'.'.$sortField, $sortDirection);
            }
        }

        return $this;
    }
}