<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleGroupedExerciseItemDataViewModel implements MultipleObjectItemDataViewModelInterface
{

    #[Groups(['admin', 'member'])]
    public int $groupId;

    #[Groups(['admin', 'member'])]
    public array $exercises;
}