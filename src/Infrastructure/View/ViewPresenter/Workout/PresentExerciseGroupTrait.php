<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedExerciseDataModelView;
use App\Infrastructure\View\ViewModel\Workout\ExerciseGroupDataViewModel;

trait PresentExerciseGroupTrait
{
    public function presentExerciseGroup(ExerciseGroupDataModel $data): ExerciseGroupDataViewModel
    {
        $groupedExercises = new ExerciseGroupDataViewModel();
        $groupedExercises->groupId = $data->id;
        $groupedExercises->movementIds = $data->movementIds;

        foreach ($data->getExercises() as $exercise) {
            $embedded = new EmbeddedExerciseDataModelView();
            $embedded->id = $exercise->id;
            $embedded->movementId = $exercise->movement->id;
            $embedded->movementName = $exercise->movement->name;

            $groupedExercises->exercises[] = $embedded;
        }

        return $groupedExercises;
    }
}