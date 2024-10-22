<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Infrastructure\DataTransformer\DateDataTransformer;
use App\Infrastructure\DataTransformer\DurationDataTransformer;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleWorkoutViewPresenter extends AbstractSingleObjectViewPresenter
{
    /**
     * @param WorkoutDataModel $data
     */
    public function presentViewData(DataModelInterface $data, string $userType): SingleWorkoutDataViewModel
    {
        $view = new SingleWorkoutDataViewModel();
        $view->id = $data->id;
        $view->name = $data->name;
        $view->status = $data->status;
        $view->visibility = $data->visibility;
        $view->endDate = DateDataTransformer::toStringFormat($data->endDate);
        $view->plannedDate = DateDataTransformer::toStringFormat($data->plannedDate);
        $view->duration = DurationDataTransformer::toHMFormat($data->duration);

        return $view;
    }
}
