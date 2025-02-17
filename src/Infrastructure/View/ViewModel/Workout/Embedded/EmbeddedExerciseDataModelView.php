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
    public string $type;

    #[Groups(['admin', 'member'])]
    public ?int $targetReps;

    #[Groups(['admin', 'member'])]
    public ?int $targetWeight;

    #[Groups(['admin', 'member'])]
    public ?int $targetDuration;

    #[Groups(['admin', 'member'])]
    public ?int $targetDistance;

    #[Groups(['admin', 'member'])]
    public ?int $targetSpeed;

    #[Groups(['admin', 'member'])]
    public ?int $reps;

    #[Groups(['admin', 'member'])]
    public ?int $weight;

    #[Groups(['admin', 'member'])]
    public ?int $duration;

    #[Groups(['admin', 'member'])]
    public ?int $distance;

    #[Groups(['admin', 'member'])]
    public ?int $speed;

    #[Groups(['admin', 'member'])]
    public bool $isCompleted;
}
