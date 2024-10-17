<?php

namespace App\Infrastructure\View\ViewModel;

use Symfony\Component\Serializer\Attribute\Groups;

final class SimpleEmbeddedObjectViewModel
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $label;

    public function __construct(
        int $id,
        string $label,
    ) {
        $this->id = $id;
        $this->label = $label;
    }
}
