<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use App\Infrastructure\Repository\CommonWhereFilterTrait;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class MovementDataModelRepository extends AbstractBaseDataModelRepository implements MovementDataModelProviderGateway
{
    use CommonWhereFilterTrait;

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

    public function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyMovementsFilterModel|FilterModelInterface $filter): self
    {
        $this->filterByIds($queryBuilder, $filter->ids);
        $this->filterByName($queryBuilder, $filter->name);

        return $this;
    }
}