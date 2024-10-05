<?php

namespace App\Infrastructure\Repository\Equipment;

use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\DTO\FilterModel\Equipment\GetManyEquipmentsFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use App\Infrastructure\Repository\CommonWhereFilterTrait;
use App\Infrastructure\Repository\GenericQueriesTrait;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class EquipmentDataModelRepository extends AbstractBaseDataModelRepository implements EquipmentDataModelProviderGateway
{
    use GenericQueriesTrait;
    use CommonWhereFilterTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipmentDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'equipment';
    }

    protected function addParametersFromFilter(
        QueryBuilder $queryBuilder,
        GetManyEquipmentsFilterModel|FilterModelInterface $filter
    ): AbstractBaseDataModelRepository {
        $this->filterByIds($queryBuilder, $filter->ids);
        $this->filterByName($queryBuilder, $filter->name);

        return $this;
    }
}