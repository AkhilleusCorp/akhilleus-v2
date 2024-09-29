<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class SingleMuscleDataViewModel implements SingleObjectDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $name;
}