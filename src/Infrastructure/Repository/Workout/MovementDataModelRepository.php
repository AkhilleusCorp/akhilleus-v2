<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class MovementDataModelRepository extends AbstractBaseDataModelRepository implements MovementDataModelProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovementDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'workout';
    }

    public function getMovementById(int $workoutId): ?MovementDataModel
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :workoutId')
            ->setParameter('workoutId', $workoutId)
            ->getQuery()->getOneOrNullResult();
    }

    public function getMovementsByFilterModel(GetManyMovementsFilterModel $filter): array
    {
        return $this->getByFilterModel($filter);
    }

    public function countMovementsByFilterModel(?GetManyMovementsFilterModel $filter): int
    {
        return $this->countByFilterModel($filter);
    }

    protected function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyMovementsFilterModel|FilterModelInterface $filter): self
    {
        if (false === empty($filter->ids)) {
            $queryBuilder->andWhere('workout.id IN (:ids)')
                ->setParameter('ids', $filter->ids);
        }

        if (false === empty($filter->name)) {
            $queryBuilder->andWhere('workout.name LIKE :name')
                ->setParameter('name', '%' . $filter->name . '%');
        }

        return $this;
    }
}