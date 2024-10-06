<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Infrastructure\View\ViewModel\SimpleEmbeddedObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleMovementItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;
use App\Infrastructure\View\ViewPresenter\MultipleObjectViewPresenterInterface;

final class MultipleMovementViewPresenter extends AbstractMultipleObjectViewPresenter implements MultipleObjectViewPresenterInterface
{
    public function presentItem(MovementDataModel|DataModelInterface $data, ?string $dataProfile): MultipleMovementItemDataViewModel
    {
        $item = new MultipleMovementItemDataViewModel();
        $item->id = $data->id;
        $item->name = $data->name;

        $item->primaryMuscle = new SimpleEmbeddedObjectViewModel($data->primaryMuscle-> id, $data->primaryMuscle->name);

        return $item;
    }
}