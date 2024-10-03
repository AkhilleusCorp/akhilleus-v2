<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\Workout\ExerciseGroupDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleExerciseGroupViewPresenter extends AbstractSingleObjectViewPresenter
{
    use PresentExerciseGroupTrait;

    public function presentViewData(ExerciseGroupDataModel|DataModelInterface $data, string $dataProfile): ExerciseGroupDataViewModel|SingleObjectDataViewModelInterface
    {
        return $this->presentExerciseGroup($data);
    }
}