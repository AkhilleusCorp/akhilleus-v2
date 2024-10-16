<?php

namespace App\Infrastructure\View\ViewModel;

use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleObjectViewModel
{
    /** @var MultipleObjectItemDataViewModelInterface[] $data */
    #[Groups(['admin', 'coach', 'member'])]
    public array $data = [];

    /** @var array<mixed> $extra */
    #[Groups(['admin', 'coach', 'member'])]
    public array $extra = [];
}
