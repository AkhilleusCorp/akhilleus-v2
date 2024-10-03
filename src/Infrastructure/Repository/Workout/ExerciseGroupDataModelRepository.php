<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
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

    /**
     * @return ExerciseGroupDataModel[]
     */
    public function getManyAllGroupsByWorkout(int $workoutId): array
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.workout = :workoutId')
            ->setParameter('workoutId', $workoutId)
            ->leftJoin($this->getAlias().'.exercises', 'group_exercises')
            ->leftJoin('group_exercises.movement', 'exercise_movement')
            ->addSelect('group_exercises', 'exercise_movement')
            ->getQuery()->getResult();
    }
}