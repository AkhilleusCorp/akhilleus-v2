<?php

namespace App\Infrastructure\View\ViewModel;

use Symfony\Component\Serializer\Attribute\Groups;

final class SingleObjectViewModel
{
    #[Groups(['admin', 'coach', 'member'])]
    public SingleObjectDataViewModelInterface $data;

    #[Groups(['admin', 'coach', 'member'])]
    public array $extra = [];
}