<?php

namespace App\Infrastructure\View\ViewModel\Equipment;

use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleEquipmentItemDataViewModel implements MultipleObjectItemDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $name;
}