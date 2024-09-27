<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDTORepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class WorkoutDataModelRepository extends AbstractBaseDTORepository implements WorkoutDataModelProviderGateway
{
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

    public function getWorkoutsByParameters(GetManyWorkoutsFilterModel $filter): array
    {
        return $this->getByParameters($filter);
    }

    public function countWorkoutsByParameters(?GetManyWorkoutsFilterModel $filter): int
    {
        return $this->countByParameters($filter);
    }

    protected function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyWorkoutsFilterModel|FilterModelInterface $filter): self
    {
        if (false === empty($filter->ids)) {
            $queryBuilder->andWhere('workout.id IN (:ids)')
                ->setParameter('ids', $filter->ids);
        }

        if (false === empty($filter->name)) {
            $queryBuilder->andWhere('workout.name LIKE :name')
                ->setParameter('name', '%' . $filter->name . '%');
        }

        if (false === empty($filter->statuses)) {
            $queryBuilder->andWhere('workout.status IN (:statuses)')
                ->setParameter('statuses', $filter->statuses);
        }

        return $this;
    }
}