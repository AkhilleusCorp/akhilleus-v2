<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedExerciseDataModelView;
use Symfony\Component\Serializer\Attribute\Groups;

final class ExerciseGroupDataViewModel implements MultipleObjectItemDataViewModelInterface, SingleObjectDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public array $movementIds;

    #[Groups(['admin', 'member'])]
    /** @var EmbeddedExerciseDataModelView[] $exercises */
    public array $exercises;
}