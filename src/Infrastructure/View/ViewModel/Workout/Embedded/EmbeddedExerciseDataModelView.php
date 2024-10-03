<?php

namespace App\Infrastructure\View\ViewModel\Workout\Embedded;

use Symfony\Component\Serializer\Attribute\Groups;

final class EmbeddedExerciseDataModelView
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public int $movementId;
    #[Groups(['admin', 'member'])]
    public string $movementName;
}