<?php

namespace App\Infrastructure\View\ViewPresenter\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Infrastructure\View\ViewModel\Workout\ExerciseGroupDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;

final class MultipleExerciseGroupViewPresenter extends AbstractMultipleObjectViewPresenter
{
    use PresentExerciseGroupTrait;

    public function __construct(private readonly EmbeddedExerciseViewPresenter $embeddedExercisePresenter)
    {
    }

    /**
     * @param ExerciseGroupDataModel $data
     */
    public function presentItem(DataModelInterface $data, ?string $userType): ExerciseGroupDataViewModel
    {
        return $this->presentExerciseGroup($data);
    }
}
