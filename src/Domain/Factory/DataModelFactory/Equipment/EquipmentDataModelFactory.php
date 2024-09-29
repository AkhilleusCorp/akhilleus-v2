<?php

namespace App\Domain\Factory\DataModelFactory\Equipment;

use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\Equipment\CreateEquipmentSourceModel;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;

final class EquipmentDataModelFactory extends AbstractDataModelFactory
{
    public function buildNewDataModel(CreateEquipmentSourceModel|CreateSourceModelInterface $source): EquipmentDataModel
    {
        $equipment = new EquipmentDataModel();
        $equipment->name = $source->name;

        return $equipment;
    }
}