<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Gateway\Provider\DropdownableDataModelProviderGateway;

interface MovementDataModelProviderGateway extends DropdownableDataModelProviderGateway
{
    public function getMovementById(int $movementId): ?MovementDataModel;

    /**
     * @return MovementDataModel[]
     */
    public function getMovementsByFilterModel(GetManyMovementsFilterModel $filter): array;

    public function countMovementsByFilterModel(?GetManyMovementsFilterModel $filter): int;

}