<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateMovementSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;
use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;

final class MovementDataModelFactory extends AbstractDataModelFactory
{
    public function __construct(
        private readonly MuscleDataModelProviderGateway $muscleProvider,
        private readonly EquipmentDataModelProviderGateway $equipmentProvider,
    ) {

    }

    public function buildNewDataModel(CreateMovementSourceModel|CreateSourceModelInterface $source): MovementDataModel
    {
        $movement = new MovementDataModel();
        $movement->name = $source->name;
        $movement->primaryMuscle = $this->muscleProvider->getOneById($source->primaryMuscle);
        $movement->setAuxiliaryMuscles($this->muscleProvider->getByArrayParameters(['id' => $source->auxiliaryMuscles]));
        $movement->setEquipments($this->equipmentProvider->getByArrayParameters(['id' => $source->equipments]));

        return $movement;
    }
}