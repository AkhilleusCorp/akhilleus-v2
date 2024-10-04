<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class ExerciseGroupDataModelRepository extends AbstractBaseDataModelRepository implements ExerciseGroupDataModelProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciseGroupDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'exercise_group';
    }

    public function getExerciseGroupById(int $groupId): ?ExerciseGroupDataModel
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :groupId')
            ->leftJoin($this->getAlias().'.workout', 'group_workout')
            ->leftJoin($this->getAlias().'.exercises', 'group_exercises')
            ->addSelect('group_workout', 'group_exercises')
            ->setParameter('groupId', $groupId)
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * @return ExerciseGroupDataModel[]
     */
    public function getManyAllGroupsByWorkout(int $workoutId): array
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.workout = :workoutId')
            ->setParameter('workoutId', $workoutId)
            ->leftJoin($this->getAlias().'.workout', 'group_workout')
            ->leftJoin($this->getAlias().'.exercises', 'group_exercises')
            ->leftJoin('group_exercises.movement', 'exercise_movement')
            ->addSelect('group_workout', 'group_exercises', 'exercise_movement')
            ->getQuery()->getResult();
    }
    protected function addParametersFromFilter(QueryBuilder $queryBuilder, FilterModelInterface $filter): AbstractBaseDataModelRepository
    {
        return $this;
    }
}