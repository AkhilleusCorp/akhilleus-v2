<?php

namespace App\Infrastructure\View\ViewModel;

use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleObjectViewModel
{
    /** @var MultipleObjectItemViewModelInterface[] */
    #[Groups(['admin', 'coach', 'member'])]
    public array $data = [];

    #[Groups(['admin', 'coach', 'member'])]
    public array $extra = [];
}