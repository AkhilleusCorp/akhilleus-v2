<?php

namespace App\Infrastructure\View\ViewModel;

use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleObjectViewModel
{
    /** @var MultipleObjectItemViewModelInterface[] */
    #[Groups('admin', 'member')]
    public array $data = [];

    #[Groups('admin', 'member')]
    public array $extra = [];
}