<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\MultipleObjectItemViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleEquipmentItemViewModel implements MultipleObjectItemViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $name;
}