<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedExerciseDataModelView;
use App\Infrastructure\View\ViewModel\Workout\MultipleGroupedExerciseItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;
use App\Infrastructure\View\ViewPresenter\MultipleObjectViewPresenterInterface;

final class MultipleGroupedExerciseViewPresenter extends AbstractMultipleObjectViewPresenter implements MultipleObjectViewPresenterInterface
{
    public function presentItem(ExerciseGroupDataModel|DataModelInterface $data, ?string $dataProfile): MultipleGroupedExerciseItemDataViewModel
    {
        $groupedExercises = new MultipleGroupedExerciseItemDataViewModel();
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