<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use App\Infrastructure\Repository\CommonWhereFilterTrait;
use App\Infrastructure\Repository\GenericQueriesTrait;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class MovementDataModelRepository extends AbstractBaseDataModelRepository implements MovementDataModelProviderGateway
{
    use GenericQueriesTrait;
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
        $queryBuilder = $this->getByFilterModel($filter);
        $queryBuilder
            ->leftJoin($this->getAlias().'.primaryMuscle', 'movement_primary_muscle')
            ->addSelect('movement_primary_muscle');

        if (null !== $filter->muscleId) {
            $queryBuilder
                ->leftJoin($this->getAlias().'.auxiliaryMuscles', 'movement_auxiliary_muscles')
                ->addSelect('movement_auxiliary_muscles');
        }

        if (null !== $filter->equipmentId) {
            $queryBuilder
                ->leftJoin($this->getAlias().'.equipments', 'movement_equipments')
                ->addSelect('movement_equipments');
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function countMovementsByFilterModel(?GetManyMovementsFilterModel $filter): int
    {
        return $this->countByFilterModel($filter);
    }

    public function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyMovementsFilterModel|FilterModelInterface $filter): self
    {
        $this->filterByIds($queryBuilder, $filter->ids);
        $this->filterByName($queryBuilder, $filter->name);

        if (false === empty($filter->muscleId)) {
            $queryBuilder->andWhere($this->getAlias().'.primaryMuscle = :muscleId')
                ->setParameter('muscleId', $filter->muscleId);
        }

        if (false === empty($filter->equipmentId)) {
            $queryBuilder->andWhere('movement_equipments = :equipmentId')
                ->setParameter('equipmentId', $filter->equipmentId);
        }

        return $this;
    }
}