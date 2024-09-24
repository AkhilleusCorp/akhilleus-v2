<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\MultipleObjectItemViewModelInterface;

final class MultipleWorkoutItemViewModel implements MultipleObjectItemViewModelInterface
{
    public int $id;
    public string $name;
    public string $status;
    public string $visibility;
}