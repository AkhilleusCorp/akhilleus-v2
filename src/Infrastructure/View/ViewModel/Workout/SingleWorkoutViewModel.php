<?php

namespace App\Infrastructure\View\ViewModel\Workout;

use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;

final class SingleWorkoutViewModel implements SingleObjectViewModelInterface
{
    public int $id;
    public string $name;
    public string $status;
    public string $visibility;
}