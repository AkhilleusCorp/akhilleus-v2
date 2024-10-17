<?php

namespace App\Infrastructure\View\ViewModel;

use Symfony\Component\Serializer\Attribute\Groups;

final class SingleObjectViewModel implements SingleObjectDataViewModelInterface
{
    #[Groups(['admin', 'coach', 'member'])]
    public SingleObjectDataViewModelInterface $data;

    /** @var array<mixed> $extra */
    #[Groups(['admin', 'coach', 'member'])]
    public array $extra = [];
}
