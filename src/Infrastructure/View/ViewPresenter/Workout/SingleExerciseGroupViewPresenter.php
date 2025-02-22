<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleExerciseGroupViewPresenter extends AbstractSingleObjectViewPresenter
{
    use PresentExerciseGroupTrait;

    public function __construct(private readonly EmbeddedExerciseViewPresenter $embeddedExercisePresenter)
    {
    }

    /**
     * @param ExerciseGroupDataModel $data
     */
    public function presentViewData(DataModelInterface $data, string $userType): SingleObjectDataViewModelInterface
    {
        return $this->presentExerciseGroup($data);
    }
}
