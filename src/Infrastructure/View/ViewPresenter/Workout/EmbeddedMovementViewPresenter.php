<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedMovementDataModelView;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedTrackedPropertyView;

final class EmbeddedMovementViewPresenter
{
    public function presentMovement(MovementDataModel $movementDataModel): EmbeddedMovementDataModelView
    {
        $embedded = new EmbeddedMovementDataModelView();
        $embedded->name = $movementDataModel->name;
        $embedded->trackedProperties = [];

        if ($movementDataModel->hasReps) {
            $embedded->trackedProperties[] = new EmbeddedTrackedPropertyView('reps', null);
        }

        if ($movementDataModel->hasWeight) {
            $embedded->trackedProperties[] = new EmbeddedTrackedPropertyView('weight', 'Kg');
        }

        if ($movementDataModel->hasDuration) {
            $embedded->trackedProperties[] = new EmbeddedTrackedPropertyView('duration', 'min');
        }

        if ($movementDataModel->hasDistance) {
            $embedded->trackedProperties[] = new EmbeddedTrackedPropertyView('distance', 'Km');
        }

        if ($movementDataModel->hasSpeed) {
            $embedded->trackedProperties[] = new EmbeddedTrackedPropertyView('speed', 'Km/h');
        }

        return $embedded;
    }
}
