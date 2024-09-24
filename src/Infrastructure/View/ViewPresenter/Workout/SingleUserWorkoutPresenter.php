<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleWorkoutWorkoutPresenter extends AbstractSingleObjectViewPresenter
{
    protected function presentForAdmin(WorkoutDataModel|DataModelInterface $data): SingleWorkoutViewModel
    {
        return $this->presentCommonData($data);
    }

    protected function presentForMember(WorkoutDataModel|DataModelInterface $data): SingleWorkoutViewModel
    {
        return $this->presentCommonData($data);
    }

    private function presentCommonData(WorkoutDataModel $data): SingleWorkoutViewModel
    {
        $view = new SingleWorkoutViewModel();
        $view->id = $data->id;
        $view->name = $data->name;
        $view->status = $data->status;
        $view->visibility = $data->visibility;

        return $view;
    }
}