<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\UseCase\API\GenericGetDropdownableUseCase;
use App\UseCase\API\Workout\CreateOneMovementUseCase;
use App\UseCase\API\Workout\DeleteOneMovementByIdUseCase;
use App\UseCase\API\Workout\GetManyMovementUseCase;
use App\UseCase\API\Workout\GetOneMovementByIdUseCase;
use App\UseCase\API\Workout\UpdateOneMovementByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MovementController extends AbstractAPIController
{
    #[Route('/movements', name:'movement_get_many', methods: ['GET'])]
    public function getMany(Request $request, GetManyMovementUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($request->query->all(), $this->getDataProfile());
    }

    #[Route('/movements/dropdownable', name:'movement', methods: ['GET'])]
    public function getDropdownable(
        GenericGetDropdownableUseCase $useCase,
        MovementDataModelProviderGateway $providerGateway
    ): array {
        return $useCase->execute('name', $providerGateway);
    }

    #[Route('/movements/{id}', name:'movement_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneById(int $id, GetOneMovementByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getDataProfile());
    }

    #[Route('/movements', name:'movement_create_one', methods: ['POST'])]
    public function createOne(Request $request, CreateOneMovementUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute(json_decode($request->getContent(), true), $this->getDataProfile());
    }

    #[Route('/movements/{id}', name:'movement_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    public function updateOneById(int $id, Request $request, UpdateOneMovementByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, json_decode($request->getContent(), true), $this->getDataProfile());
    }

    #[Route('/movements/{id}', name:'movement_delete_one_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteOneById(int $id, DeleteOneMovementByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}