<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class SingleWorkoutDataViewModel implements SingleObjectDataViewModelInterface
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