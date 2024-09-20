<?php

namespace App\Domain\Factory\DataModelFactory\Equipment;

use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\DTO\SourceModel\Equipment\CreateEquipmentSourceModel;

final class EquipmentDataModelFactory
{
    public function buildNewEquipmentDataModel(CreateEquipmentSourceModel $source): EquipmentDataModel
    {
        $equipment = new EquipmentDataModel();
        $equipment->name = $source->name;

        return $equipment;
    }
}