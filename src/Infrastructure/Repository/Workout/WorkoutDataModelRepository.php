<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use App\Infrastructure\Repository\CommonWhereFilterTrait;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class WorkoutDataModelRepository extends AbstractBaseDataModelRepository implements WorkoutDataModelProviderGateway
{
    use CommonWhereFilterTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkoutDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'workout';
    }

    public function getWorkoutById(int $workoutId): ?WorkoutDataModel
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :workoutId')
            ->setParameter('workoutId', $workoutId)
            ->getQuery()->getOneOrNullResult();
    }

    public function getWorkoutsByFilterModel(GetManyWorkoutsFilterModel $filter): array
    {
        return $this->getByFilterModel($filter)->getQuery()->getResult();
    }

    public function countWorkoutsByFilterModel(?GetManyWorkoutsFilterModel $filter): int
    {
        return $this->countByFilterModel($filter);
    }

    public function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyWorkoutsFilterModel|FilterModelInterface $filter): self
    {
        $this->filterByIds($queryBuilder, $filter->ids);
        $this->filterByName($queryBuilder, $filter->name);
        $this->filterByStatus($queryBuilder, $filter->status);

        return $this;
    }
}