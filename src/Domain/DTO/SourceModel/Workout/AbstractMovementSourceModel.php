<?php

namespace App\Domain\DTO\SourceModel\Workout;

abstract class AbstractMovementSourceModel
{
    public string $name;
    public string $status;

    public bool $hasReps = false;
    public bool $hasWeight = false;
    public bool $hasDuration = false;
    public bool $hasDistance = false;
    public bool $hasSpeed = false;

    public int $primaryMuscle;
    /** @var int[]|null */
    public ?array $auxiliaryMuscles = null;
    /** @var int[]|null */
    public ?array $equipments = null;
}
