<?php

namespace App\Infrastructure\View\ViewModel\Workout\Embedded;

use Symfony\Component\Serializer\Attribute\Groups;

final class EmbeddedMovementDataModelView
{
    #[Groups(['admin', 'member'])]
    public string $name;

    /** @var EmbeddedTrackedPropertyView[] */
    #[Groups(['admin', 'member'])]
    public array $trackedProperties;
}
