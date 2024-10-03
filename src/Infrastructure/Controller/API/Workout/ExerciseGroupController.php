<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Infrastructure\Controller\API\AbstractAPIController;
use App\UseCase\API\Workout\DeleteOneExerciseGroupByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExerciseGroupController extends AbstractAPIController
{
    #[Route('/workouts/{workoutId}/groups/{groupId}', name:'exercise_group_delete_one_by_id', requirements: ['workoutId' => '\d+', 'groupId' => '\d+'], methods: ['DELETE'])]
    public function deleteOneById(int $workoutId, int $groupId, DeleteOneExerciseGroupByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($workoutId, $groupId);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}