<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleWorkoutViewPresenter extends AbstractSingleObjectViewPresenter
{
    public function presentViewData(WorkoutDataModel|DataModelInterface $data, string $dataProfile): SingleWorkoutDataViewModel
    {
        $view = new SingleWorkoutDataViewModel();
        $view->id = $data->id;
        $view->name = $data->name;
        $view->status = $data->status;
        $view->visibility = $data->visibility;

        return $view;
    }
}