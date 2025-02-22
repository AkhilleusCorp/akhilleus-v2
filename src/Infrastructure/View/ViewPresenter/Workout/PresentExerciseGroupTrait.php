<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
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
            $this->embeddedExercisePresenter->presentExercise($groupedExercises, $exercise);
        }

        return $groupedExercises;
    }
}
