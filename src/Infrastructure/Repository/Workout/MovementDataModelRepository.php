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
        return 'movement';
    }

    public function getMovementById(int $movementId): ?MovementDataModel
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :movementId')
            ->setParameter('movementId', $movementId)
            ->leftJoin($this->getAlias().'.primaryMuscle', 'movement_primary_muscle')
            ->leftJoin($this->getAlias().'.auxiliaryMuscles', 'movement_auxiliary_muscle')
            ->leftJoin($this->getAlias().'.equipments', 'movement_equipments')
            ->addSelect('movement_primary_muscle', 'movement_auxiliary_muscle', 'movement_equipments')
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
            $queryBuilder->andWhere('movement.id IN (:ids)')
                ->setParameter('ids', $filter->ids);
        }

        if (false === empty($filter->name)) {
            $queryBuilder->andWhere('movement.name LIKE :name')
                ->setParameter('name', '%' . $filter->name . '%');
        }

        return $this;
    }
}