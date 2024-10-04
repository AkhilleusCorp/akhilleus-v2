<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Infrastructure\View\ViewModel\Workout\ExerciseGroupDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;
use App\Infrastructure\View\ViewPresenter\MultipleObjectViewPresenterInterface;

final class MultipleExerciseGroupViewPresenter extends AbstractMultipleObjectViewPresenter implements MultipleObjectViewPresenterInterface
{
    use PresentExerciseGroupTrait;

    public function presentItem(ExerciseGroupDataModel|DataModelInterface $data, ?string $dataProfile): ExerciseGroupDataViewModel
    {
        return $this->presentExerciseGroup($data);
    }
}