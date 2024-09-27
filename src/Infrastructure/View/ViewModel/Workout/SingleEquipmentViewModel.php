<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class SingleEquipmentViewModel implements SingleObjectViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $name;
}