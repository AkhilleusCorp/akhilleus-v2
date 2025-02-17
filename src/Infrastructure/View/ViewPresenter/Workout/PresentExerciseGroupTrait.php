<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedExerciseDataModelView;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedMovementDataModelView;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedTrackedPropertyView;
use App\Infrastructure\View\ViewModel\Workout\ExerciseGroupDataViewModel;

trait PresentExerciseGroupTrait
{
    public function presentExerciseGroup(ExerciseGroupDataModel $data): ExerciseGroupDataViewModel
    {
        $groupedExercises = new ExerciseGroupDataViewModel();
        $groupedExercises->id = $data->id;
        $groupedExercises->workoutId = $data->workout->id;
        $groupedExercises->movementConfigs = [];

        foreach ($data->exercises->toArray() as $exercise) {
            $embedded = new EmbeddedExerciseDataModelView();
            $embedded->id = $exercise->id;

            $embedded->movementId = $exercise->movement->id;
            if (false === isset($groupedExercises->movementConfigs[$embedded->movementId])) {
                $groupedExercises->movementConfigs[$embedded->movementId] = $this->computeMovementConfig($exercise->movement);
            }

            $embedded->type = $exercise->type;

            $embedded->targetReps = null === $exercise->targetReps ? 0 : $exercise->targetReps;
            $embedded->targetWeight = null === $exercise->targetWeight ? 0 : $exercise->targetWeight;
            $embedded->targetDuration = null === $exercise->targetDuration ? 0 : $exercise->targetDuration;
            $embedded->targetDistance = null === $exercise->targetDistance ? 0 : $exercise->targetDistance;
            $embedded->targetSpeed = null === $exercise->targetSpeed ? 0 : $exercise->targetSpeed;

            $embedded->reps = null === $exercise->reps ? 0 : $exercise->reps;
            $embedded->weight = null === $exercise->weight ? 0 : $exercise->weight;
            $embedded->duration = null === $exercise->duration ? 0 : $exercise->duration;
            $embedded->distance = null === $exercise->distance ? 0 : $exercise->distance;
            $embedded->speed = null === $exercise->speed ? 0 : $exercise->speed;

            $groupedExercises->exercises[] = $embedded;
        }

        return $groupedExercises;
    }

    private function computeMovementConfig(MovementDataModel $movementDataModel): EmbeddedMovementDataModelView
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
