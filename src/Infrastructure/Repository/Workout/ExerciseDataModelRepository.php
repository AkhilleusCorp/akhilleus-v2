<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Gateway\Provider\Workout\ExerciseDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class ExerciseDataModelRepository extends AbstractBaseDataModelRepository implements ExerciseDataModelProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciseDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'exercise';
    }

    public function getExerciseById(int $exerciseId): ?ExerciseDataModel
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.id = :exerciseId')
            ->setParameter('exerciseId', $exerciseId)
            ->leftJoin($this->getAlias().'.group', 'exercise_group')
            ->addSelect('exercise_group')
            ->getQuery()->getOneOrNullResult();
    }

    protected function addParametersFromFilter(QueryBuilder $queryBuilder, FilterModelInterface $filter): AbstractBaseDataModelRepository
    {
        return $this;
    }
}