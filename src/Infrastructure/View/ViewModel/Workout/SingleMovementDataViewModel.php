<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\SimpleEmbeddedObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class SingleMovementDataViewModel implements SingleObjectDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $name;

    #[Groups(['admin', 'member'])]
    public string $status;

    #[Groups(['admin', 'member'])]
    public bool $hasReps = false;
    #[Groups(['admin', 'member'])]
    public bool $hasWeight = false;
    #[Groups(['admin', 'member'])]
    public bool $hasDuration = false;
    #[Groups(['admin', 'member'])]
    public bool $hasDistance = false;
    #[Groups(['admin', 'member'])]
    public bool $hasSpeed = false;

    #[Groups(['admin', 'member'])]
    public SimpleEmbeddedObjectViewModel $primaryMuscle;

    /** @var SimpleEmbeddedObjectViewModel[] $auxiliaryMuscles */
    #[Groups(['admin', 'member'])]
    public array $auxiliaryMuscles;

    /** @var SimpleEmbeddedObjectViewModel[] $equipments */
    #[Groups(['admin', 'member'])]
    public array $equipments;
}
