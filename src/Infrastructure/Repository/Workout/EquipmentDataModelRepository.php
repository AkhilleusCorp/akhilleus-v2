<?php

namespace App\Infrastructure\Repository\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDTORepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class EquipmentDataModelRepository extends AbstractBaseDTORepository implements GenericDataModelProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipmentDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'equipment';
    }

    protected function addParametersFromFilter(QueryBuilder $queryBuilder, FilterModelInterface $filter): self
    {
        return $this;
    }
}