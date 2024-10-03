<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\UseCase\API\Workout\GetGroupedExerciseUseCase;
use Symfony\Component\Routing\Attribute\Route;

final class ExerciseController extends AbstractAPIController
{
    #[Route('/workouts/{workoutId}/exercises', name:'workout_get_grouped_exercises', requirements: ['workoutId' => '\d+'], methods: ['GET'])]
    public function getGroupedExercises(int $workoutId, GetGroupedExerciseUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($workoutId, $this->getDataProfile());
    }
}