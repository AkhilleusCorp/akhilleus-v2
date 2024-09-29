<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleWorkoutItemDataViewModel implements MultipleObjectItemDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $name;

    #[Groups(['admin', 'member'])]
    public string $status;

    #[Groups(['admin', 'member'])]
    public string $visibility;
}