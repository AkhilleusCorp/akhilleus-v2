<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleWorkoutItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;
use App\Infrastructure\View\ViewPresenter\MultipleObjectViewPresenterInterface;

final class MultipleWorkoutViewPresenter extends AbstractMultipleObjectViewPresenter implements MultipleObjectViewPresenterInterface
{
    /**
     * @param WorkoutDataModel $data
     */
    public function presentItem(DataModelInterface $data, ?string $userType): MultipleWorkoutItemDataViewModel
    {
        $item = new MultipleWorkoutItemDataViewModel();
        $item->id = $data->id;
        $item->name = $data->name;
        $item->status = $data->status;
        $item->visibility = $data->visibility;

        return $item;
    }
}
