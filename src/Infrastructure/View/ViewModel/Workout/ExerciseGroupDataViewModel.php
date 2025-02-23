<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedExerciseDataModelView;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedMovementDataModelView;
use Symfony\Component\Serializer\Attribute\Groups;

final class ExerciseGroupDataViewModel implements MultipleObjectItemDataViewModelInterface, SingleObjectDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public ?int $restDuration = null;

    #[Groups(['admin', 'member'])]
    public int $workoutId;

    /** @var EmbeddedMovementDataModelView[] */
    #[Groups(['admin', 'member'])]
    public array $movementConfigs;

    /** @var EmbeddedExerciseDataModelView[] $exercises */
    #[Groups(['admin', 'member'])]
    public array $exercises;
}
