<?php

namespace App\Infrastructure\Repository\Equipment;

use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use App\Infrastructure\Repository\GenericQueriesTrait;
use Doctrine\Persistence\ManagerRegistry;

final class EquipmentDataModelRepository extends AbstractBaseDataModelRepository implements EquipmentDataModelProviderGateway
{
    use GenericQueriesTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipmentDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'equipment';
    }
}