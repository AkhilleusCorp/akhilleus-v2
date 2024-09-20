<?php

namespace App\Domain\Factory\SourceModelFactory\Equipment;

use App\Domain\DTO\SourceModel\Equipment\CreateEquipmentSourceModel;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class CreateEquipmentSourceModelFactory implements SourceModelFactoryInterface
{
    public function buildSourceModel(array $parameters): CreateEquipmentSourceModel
    {
        $source = new CreateEquipmentSourceModel();
        $source->name = $parameters['name'];

        return $source;
    }
}