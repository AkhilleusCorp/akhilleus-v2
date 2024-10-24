<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Domain\Registry\User\UserStatusRegistry;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\UseCase\API\Workout\CreateOneWorkoutUseCase;
use App\UseCase\API\Workout\DeleteOneWorkoutByIdUseCase;
use App\UseCase\API\Workout\GetManyWorkoutUseCase;
use App\UseCase\API\Workout\GetOneWorkoutByIdUseCase;
use App\UseCase\API\Workout\UpdateOneWorkoutByIdUseCase;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[OA\Tag('WORKOUTS')]
final class WorkoutController extends AbstractAPIController
{
    #[Route('/workouts', name: 'workout_get_many', methods: ['GET'])]
    #[OA\Parameter(name: 'ids', in: 'query', required: false, schema: new OA\Schema(type: 'array', items: new OA\Items(type: 'integer')))]
    #[OA\Parameter(name: 'name', in: 'query', required: false, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'memberId', in: 'query', required: false, schema: new OA\Schema(type: 'number'))]
    #[OA\Parameter(name: 'status', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: UserStatusRegistry::USER_STATUSES))]
    #[OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'number'))]
    #[OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: 200,
        description: 'Successfully returns a list of Workouts',
        content: new Model(type: MultipleObjectViewModel::class)
    )]
    public function getMany(Request $request, GetManyWorkoutUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($request->query->all(), $this->getTokenPayload($request));
    }

    #[Route('/workouts/{id}', name: 'workout_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneById(Request $request, int $id, GetOneWorkoutByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getTokenPayload($request));
    }

    #[Route('/workouts', name: 'workout_create_one', methods: ['POST'])]
    public function createOne(Request $request, CreateOneWorkoutUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute(json_decode($request->getContent(), true), $this->getTokenPayload($request));
    }

    #[Route('/workouts/{id}', name: 'workout_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    public function updateOneById(Request $request, int $id, UpdateOneWorkoutByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, json_decode($request->getContent(), true), $this->getTokenPayload($request));
    }

    #[Route('/workouts/{id}', name: 'workout_delete_one_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteOneById(int $id, DeleteOneWorkoutByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
