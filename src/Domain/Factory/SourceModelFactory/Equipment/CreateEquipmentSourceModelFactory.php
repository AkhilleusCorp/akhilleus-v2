<?php

namespace App\Domain\Factory\SourceModelFactory\Equipment;

use App\Domain\DTO\SourceModel\Equipment\CreateEquipmentSourceModel;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class CreateEquipmentSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    public function buildSourceModel(array $parameters): CreateEquipmentSourceModel|SourceModelInterface
    {
        return $this->inferSourceModel($parameters, new CreateEquipmentSourceModel());
    }
}