<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use App\Infrastructure\Repository\GenericQueriesTrait;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class MuscleDataModelRepository extends AbstractBaseDataModelRepository implements MuscleDataModelProviderGateway
{
    use GenericQueriesTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MuscleDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'muscle';
    }

    protected function addParametersFromFilter(QueryBuilder $queryBuilder, FilterModelInterface $filter): self
    {
        return $this;
    }
}