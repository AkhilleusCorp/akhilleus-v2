<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Infrastructure\View\ViewModel\SimpleEmbeddedObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleMovementItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;

final class MultipleMovementViewPresenter extends AbstractMultipleObjectViewPresenter
{
    /**
     * @param MovementDataModel $data
     */
    public function presentItem(DataModelInterface $data, ?string $userType): MultipleMovementItemDataViewModel
    {
        $item = new MultipleMovementItemDataViewModel();
        $item->id = $data->id;
        $item->name = $data->name;
        $item->status = $data->status;

        $item->primaryMuscle = new SimpleEmbeddedObjectViewModel($data->primaryMuscle->id, $data->primaryMuscle->name);

        return $item;
    }
}
