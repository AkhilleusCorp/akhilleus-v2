<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
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

    /**
     * @param CreateMovementSourceModel $source
     */
    public function buildNewDataModel(CreateSourceModelInterface $source): MovementDataModel
    {
        $movement = new MovementDataModel();
        $movement->name = $source->name;

        return $this->handleConnectedDataModels($movement, $source);
    }

    /**
     * @param MovementDataModel         $dataModel
     * @param UpdateMovementSourceModel $sourceModel
     */
    public function mergeSourceAndDataModel(
        DataModelInterface $dataModel,
        UpdateSourceModelInterface $sourceModel,
    ): MovementDataModel {
        $dataModel = $this->handleConnectedDataModels($dataModel, $sourceModel);
        $dataModel->name = $sourceModel->name;
        $dataModel->status = $sourceModel->status;

        return $dataModel;
    }

    private function handleConnectedDataModels(
        MovementDataModel $dataModel,
        CreateMovementSourceModel|UpdateMovementSourceModel $sourceModel,
    ): MovementDataModel {
        /** @var ?MuscleDataModel $primaryMuscle */
        $primaryMuscle = $this->muscleProvider->getOneById($sourceModel->primaryMuscle);
        if (null === $primaryMuscle) {
            throw new \LogicException('Cannot create a movement on a non existing muscle.');
        }

        $dataModel->primaryMuscle = $primaryMuscle;

        if (null !== $sourceModel->auxiliaryMuscles) {
            /** @var MuscleDataModel[] $muscles */
            $muscles = $this->muscleProvider->getByArrayParameters(['id' => $sourceModel->auxiliaryMuscles]);
            $dataModel->setAuxiliaryMuscles($muscles);
        }

        if (null !== $sourceModel->equipments) {
            /** @var EquipmentDataModel[] $equipments */
            $equipments = $this->equipmentProvider->getByArrayParameters(['id' => $sourceModel->equipments]);
            $dataModel->setEquipments($equipments);
        }

        return $dataModel;
    }
}
