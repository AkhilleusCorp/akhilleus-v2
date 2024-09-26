<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutViewModel;
use App\Infrastructure\View\ViewPresenter\SingleObjectViewPresenterInterface;

final class SingleWorkoutViewPresenter implements SingleObjectViewPresenterInterface
{
    public function present(WorkoutDataModel|DataModelInterface $data, string $dataProfile): SingleWorkoutViewModel
    {
        $view = new SingleWorkoutViewModel();
        $view->id = $data->id;
        $view->name = $data->name;
        $view->status = $data->status;
        $view->visibility = $data->visibility;

        return $view;
    }
}