<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\UseCase\API\Workout\AddExercisesByGroupIdUseCase;
use App\UseCase\API\Workout\DeleteOneExerciseGroupByIdUseCase;
use App\UseCase\API\Workout\GetManyExerciseGroupUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExerciseGroupController extends AbstractAPIController
{
    #[Route('/workouts/{workoutId}/groups', name:'exercise_group_get_many', requirements: ['workoutId' => '\d+'], methods: ['GET'])]
    public function getMany(int $workoutId, GetManyExerciseGroupUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($workoutId, $this->getDataProfile());
    }

    #[Route('/workouts/{workoutId}/groups/{groupId}/exercises', name:'exercise_group_add_exercises_by_group_id', requirements: ['workoutId' => '\d+', 'groupId' => '\d+'], methods: ['PATCH'])]
    public function addExercisesByGroupId(int $workoutId, int $groupId, AddExercisesByGroupIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($workoutId, $groupId, $this->getDataProfile());
    }

    #[Route('/workouts/{workoutId}/groups/{groupId}', name:'exercise_group_delete_one_by_id', requirements: ['workoutId' => '\d+', 'groupId' => '\d+'], methods: ['DELETE'])]
    public function deleteOneById(int $workoutId, int $groupId, DeleteOneExerciseGroupByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($workoutId, $groupId);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}