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

        $primaryMuscle = $this->muscleProvider->getOneById($source->primaryMuscle);
        if (null === $primaryMuscle) {
            throw new \LogicException("Cannot create a movement on a non existing muscle.");
        }

        $movement->primaryMuscle = $primaryMuscle;
        if (null !== $source->auxiliaryMuscles) {
            $movement->setAuxiliaryMuscles($this->muscleProvider->getByArrayParameters(['id' => $source->auxiliaryMuscles]));
        }

        if (null !== $source->equipments) {
            $movement->setEquipments($this->equipmentProvider->getByArrayParameters(['id' => $source->equipments]));
        }

        return $movement;
    }
}