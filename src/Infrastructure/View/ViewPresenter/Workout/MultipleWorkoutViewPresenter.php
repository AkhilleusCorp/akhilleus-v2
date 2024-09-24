<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleWorkoutItemViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;

final class MultipleWorkoutViewPresenter extends AbstractMultipleObjectViewPresenter
{
    protected function presentForAdmin(WorkoutDataModel|DataModelInterface $data): MultipleWorkoutItemViewModel
    {
        return $this->presentCommonData($data);
    }

    protected function presentForMember(WorkoutDataModel|DataModelInterface $data): MultipleWorkoutItemViewModel
    {
        return $this->presentCommonData($data);
    }

    private function presentCommonData(WorkoutDataModel $data): MultipleWorkoutItemViewModel
    {
        $item = new MultipleWorkoutItemViewModel();
        $item->id = $data->id;
        $item->name = $data->name;
        $item->status = $data->status;
        $item->visibility = $data->visibility;

        return $item;
    }
}