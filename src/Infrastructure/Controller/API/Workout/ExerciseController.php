<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\UseCase\API\Workout\AddExercisesByGroupIdUseCase;
use App\UseCase\API\Workout\DeleteOneExerciseByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExerciseController extends AbstractAPIController
{
    #[Route('/workouts/{workoutId}/groups/{groupId}/exercises', name: 'exercise_add_by_group_id', requirements: ['workoutId' => '\d+', 'groupId' => '\d+'], methods: ['PATCH'])]
    public function addExercisesByGroupId(Request $request, int $workoutId, int $groupId, AddExercisesByGroupIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($workoutId, $groupId, $this->getTokenPayload($request));
    }

    #[Route('/workouts/{workoutId}/exercises/{exerciseId}', name: 'exercise_delete_one_by_id', requirements: ['workoutId' => '\d+', 'exerciseId' => '\d+'], methods: ['DELETE'])]
    public function deleteOneById(int $workoutId, int $exerciseId, DeleteOneExerciseByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($workoutId, $exerciseId);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
