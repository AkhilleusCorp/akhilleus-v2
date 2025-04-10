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
        $groupedExercises->restDuration = $data->restDuration;
        $groupedExercises->workoutId = $data->workout->id;
        $groupedExercises->movementConfigs = [];

        $exerciseNames = [];
        foreach ($data->exercises->toArray() as $exercise) {
            $exerciseNames[$exercise->movement->name] = $exercise->movement->name;
            $this->embeddedExercisePresenter->presentExercise($groupedExercises, $exercise);
        }

        $groupedExercises->name = implode(' / ', $exerciseNames);

        return $groupedExercises;
    }
}
