<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Domain\DTO\SourceModel\Workout\CreateExerciseGroupSourceModel;
use App\Infrastructure\ApiDoc;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\ExerciseGroupDataViewModel;
use App\UseCase\API\Workout\CreateOneExerciseGroupUseCase;
use App\UseCase\API\Workout\DeleteOneExerciseGroupByIdUseCase;
use App\UseCase\API\Workout\GetManyExerciseGroupUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[ApiDoc\DocSection('EXERCISE GROUPS')]
final class ExerciseGroupController extends AbstractAPIController
{
    #[Route('/workouts/{workoutId}/groups', name: 'exercise_group_get_many', requirements: ['workoutId' => '\d+'], methods: ['GET'])]
    #[ApiDoc\MultipleObjectResponse(
        response: 200,
        description: 'Successfully returns a list of ExerciseGroups',
        dataClass: ExerciseGroupDataViewModel::class,
    )]
    public function getMany(Request $request, int $workoutId, GetManyExerciseGroupUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($workoutId, $this->getTokenPayload($request));
    }

    #[Route('/workouts/{workoutId}/groups', name: 'exercise_group_create_one', requirements: ['workoutId' => '\d+'], methods: ['POST'])]
    #[ApiDoc\PostParameters(dataClass: CreateExerciseGroupSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully returns the details of an Exercise Group',
        dataClass: ExerciseGroupDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Workout found for the given id',
    )]
    public function createOneExerciseGroup(Request $request, int $workoutId, CreateOneExerciseGroupUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute(
            $workoutId,
            json_decode($request->getContent(), true),
            $this->getTokenPayload($request)
        );
    }

    #[Route('/workouts/{workoutId}/groups/{groupId}', name: 'exercise_group_delete_one_by_id', requirements: ['workoutId' => '\d+', 'groupId' => '\d+'], methods: ['DELETE'])]
    #[ApiDoc\NotFoundResponse(
        description: 'No ExerciseGroup found for the given id',
    )]
    public function deleteOneById(int $workoutId, int $groupId, DeleteOneExerciseGroupByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($workoutId, $groupId);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
