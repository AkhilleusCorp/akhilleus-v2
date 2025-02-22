<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseDataModel;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedExerciseDataModelView;
use App\Infrastructure\View\ViewModel\Workout\ExerciseGroupDataViewModel;

final class EmbeddedExerciseViewPresenter
{
    public function __construct(private readonly EmbeddedMovementViewPresenter $embeddedMovementViewPresenter)
    {
    }

    public function presentExercise(ExerciseGroupDataViewModel $groupedExercises, ExerciseDataModel $exercise): EmbeddedExerciseDataModelView
    {
        $embedded = new EmbeddedExerciseDataModelView();
        $embedded->id = $exercise->id;

        $embedded->movementId = $exercise->movement->id;
        if (false === isset($groupedExercises->movementConfigs[$embedded->movementId])) {
            $groupedExercises->movementConfigs[$embedded->movementId] = $this->embeddedMovementViewPresenter->presentMovement($exercise->movement);
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

        return $embedded;
    }
}
