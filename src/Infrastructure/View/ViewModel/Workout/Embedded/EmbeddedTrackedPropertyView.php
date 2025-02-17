<?php

namespace App\Infrastructure\View\ViewModel\Workout\Embedded;

use Symfony\Component\Serializer\Attribute\Groups;

class EmbeddedTrackedPropertyView
{
    #[Groups(['admin', 'member'])]
    public string $name;

    #[Groups(['admin', 'member'])]
    public ?string $unit;

    public function __construct(
        string $name,
        ?string $unit,
    ) {
        $this->name = $name;
        $this->unit = $unit;
    }
}
