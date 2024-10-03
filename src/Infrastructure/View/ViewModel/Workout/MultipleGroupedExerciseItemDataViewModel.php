<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use App\Infrastructure\View\ViewModel\Workout\Embedded\EmbeddedExerciseDataModelView;
use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleGroupedExerciseItemDataViewModel implements MultipleObjectItemDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $groupId;

    #[Groups(['admin', 'member'])]
    public array $movementIds;

    #[Groups(['admin', 'member'])]
    /** @var EmbeddedExerciseDataModelView[] $exercises */
    public array $exercises;
}