<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateMovementSourceModel;
use App\Domain\DTO\SourceModel\Workout\UpdateMovementSourceModel;
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

        return $this->handleConnectedDataModels($movement, $source);
    }

    public function mergeSourceAndDataModel(
        MovementDataModel|DataModelInterface $dataModel,
        UpdateMovementSourceModel|UpdateSourceModelInterface $sourceModel
    ): MovementDataModel|DataModelInterface {
        $dataModel = $this->handleConnectedDataModels($dataModel, $sourceModel);

        $dataModel->name = $sourceModel->name;
        $dataModel->status = $sourceModel->status;

        return $dataModel;
    }

    private function handleConnectedDataModels(
        MovementDataModel $dataModel,
        CreateMovementSourceModel|UpdateMovementSourceModel $sourceModel
    ): MovementDataModel {
        $primaryMuscle = $this->muscleProvider->getOneById($sourceModel->primaryMuscle);
        if (null === $primaryMuscle) {
            throw new \LogicException("Cannot create a movement on a non existing muscle.");
        }

        $dataModel->primaryMuscle = $primaryMuscle;

        if (null !== $sourceModel->auxiliaryMuscles) {
            $dataModel->setAuxiliaryMuscles($this->muscleProvider->getByArrayParameters(['id' => $sourceModel->auxiliaryMuscles]));
        }

        if (null !== $sourceModel->equipments) {
            $dataModel->setEquipments($this->equipmentProvider->getByArrayParameters(['id' => $sourceModel->equipments]));
        }

        return $dataModel;
    }
}