<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;
use App\Domain\DTO\SourceModel\Workout\CreateWorkoutSourceModel;
use App\Domain\DTO\SourceModel\Workout\UpdateWorkoutSourceModel;
use App\Infrastructure\ApiDoc;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleWorkoutItemDataViewModel;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutDataViewModel;
use App\UseCase\API\Workout\CreateOneWorkoutUseCase;
use App\UseCase\API\Workout\DeleteOneWorkoutByIdUseCase;
use App\UseCase\API\Workout\GetManyWorkoutsUseCase;
use App\UseCase\API\Workout\GetOneWorkoutByIdUseCase;
use App\UseCase\API\Workout\UpdateOneWorkoutByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[ApiDoc\DocSection('WORKOUTS')]
final class WorkoutController extends AbstractAPIController
{
    #[Route('/workouts', name: 'workout_get_many', methods: ['GET'])]
    #[ApiDoc\GetParameters(dataClass: GetManyWorkoutsFilterModel::class)]
    #[ApiDoc\MultipleObjectResponse(
        response: 200,
        description: 'Successfully returns a list of Workouts',
        dataClass: MultipleWorkoutItemDataViewModel::class,
    )]
    public function getMany(Request $request, GetManyWorkoutsUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($this->getRequestBody($request), $this->getTokenPayload($request));
    }

    #[Route('/workouts/{id}', name: 'workout_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully returns the details of a Workout',
        dataClass: SingleWorkoutDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Workout found for the given id',
    )]
    public function getOneById(Request $request, int $id, GetOneWorkoutByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getTokenPayload($request));
    }

    #[Route('/workouts', name: 'workout_create_one', methods: ['POST'])]
    #[ApiDoc\PostParameters(dataClass: CreateWorkoutSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully create a Workout',
        dataClass: SingleWorkoutDataViewModel::class,
    )]
    public function createOne(Request $request, CreateOneWorkoutUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($this->getRequestBody($request), $this->getTokenPayload($request));
    }

    #[Route('/workouts/{id}', name: 'workout_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[ApiDoc\PostParameters(dataClass: UpdateWorkoutSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully edit the details of a Workout',
        dataClass: SingleWorkoutDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Workout found for the given id',
    )]
    public function updateOneById(Request $request, int $id, UpdateOneWorkoutByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getRequestBody($request), $this->getTokenPayload($request));
    }

    #[Route('/workouts/{id}', name: 'workout_delete_one_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    #[ApiDoc\NotFoundResponse(
        description: 'No Workout found for the given id',
    )]
    public function deleteOneById(int $id, DeleteOneWorkoutByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
