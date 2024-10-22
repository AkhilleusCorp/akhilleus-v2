<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
use App\Infrastructure\View\ViewModel\SimpleEmbeddedObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\SingleMovementDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleMovementViewPresenter extends AbstractSingleObjectViewPresenter
{
    /**
     * @param MovementDataModel $data
     */
    public function presentViewData(DataModelInterface $data, string $userType): SingleMovementDataViewModel
    {
        $view = new SingleMovementDataViewModel();
        $view->id = $data->id;
        $view->name = $data->name;
        $view->status = $data->status;
        $view->primaryMuscle = new SimpleEmbeddedObjectViewModel($data->primaryMuscle->id, $data->primaryMuscle->name);
        $view->auxiliaryMuscles = $this->getAuxiliaryMusclesAsEmbedded($data->auxiliaryMuscles->toArray());
        $view->equipments = $this->getEquipmentsAsEmbedded($data->equipments->toArray());

        return $view;
    }

    /**
     * @param MuscleDataModel[] $auxiliaryMuscles
     *
     * @return SimpleEmbeddedObjectViewModel[]
     */
    private function getAuxiliaryMusclesAsEmbedded(array $auxiliaryMuscles): array
    {
        $embeddedObjects = [];
        foreach ($auxiliaryMuscles as $auxiliaryMuscle) {
            $embeddedObjects[] = new SimpleEmbeddedObjectViewModel($auxiliaryMuscle->id, $auxiliaryMuscle->name);
        }

        return $embeddedObjects;
    }

    /**
     * @param EquipmentDataModel[] $equipments
     *
     * @return SimpleEmbeddedObjectViewModel[]
     */
    private function getEquipmentsAsEmbedded(array $equipments): array
    {
        $embeddedObjects = [];
        foreach ($equipments as $equipment) {
            $embeddedObjects[] = new SimpleEmbeddedObjectViewModel($equipment->id, $equipment->name);
        }

        return $embeddedObjects;
    }
}
