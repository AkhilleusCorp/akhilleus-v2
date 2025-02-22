<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\DTO\SourceModel\Workout\CreateMovementSourceModel;
use App\Domain\DTO\SourceModel\Workout\UpdateMovementSourceModel;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\ApiDoc;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleMovementItemDataViewModel;
use App\Infrastructure\View\ViewModel\Workout\SingleMovementDataViewModel;
use App\UseCase\API\GenericGetDropdownableUseCase;
use App\UseCase\API\Workout\CreateOneMovementUseCase;
use App\UseCase\API\Workout\DeleteOneMovementByIdUseCase;
use App\UseCase\API\Workout\FetchManyMovementsUseCase;
use App\UseCase\API\Workout\FetchOneMovementByIdUseCase;
use App\UseCase\API\Workout\UpdateOneMovementByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[ApiDoc\DocSection('MOVEMENTS')]
final class MovementController extends AbstractAPIController
{
    #[Route('/movements/fetch', name: 'movement_get_many', methods: ['POST'])]
    #[ApiDoc\RequestBodyParameters(dataClass: GetManyMovementsFilterModel::class)]
    #[ApiDoc\MultipleObjectResponse(
        response: 200,
        description: 'Successfully returns a list of Movements',
        dataClass: MultipleMovementItemDataViewModel::class,
    )]
    public function fetchMany(Request $request, FetchManyMovementsUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($this->getRequestBody($request), $this->getTokenPayload($request));
    }

    /**
     * @return array<string, string>
     */
    #[Route('/movements/dropdownable', name: 'movement', methods: ['GET'])]
    public function getDropdownable(
        GenericGetDropdownableUseCase $useCase,
        MovementDataModelProviderGateway $providerGateway,
    ): array {
        return $useCase->execute('name', $providerGateway);
    }

    #[Route('/movements/{id}/fetch', name: 'movement_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully returns the details of a Movement',
        dataClass: SingleMovementDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Movement found for the given id',
    )]
    public function fetchOneById(Request $request, int $id, FetchOneMovementByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getTokenPayload($request));
    }

    #[Route('/movements/create', name: 'movement_create_one', methods: ['POST'])]
    #[ApiDoc\RequestBodyParameters(dataClass: CreateMovementSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully create a Movement',
        dataClass: SingleMovementDataViewModel::class,
    )]
    public function createOne(Request $request, CreateOneMovementUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($this->getRequestBody($request), $this->getTokenPayload($request));
    }

    #[Route('/movements/{id}/update', name: 'movement_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[ApiDoc\RequestBodyParameters(dataClass: UpdateMovementSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully edit the details of a Movement',
        dataClass: SingleMovementDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Movement found for the given id',
    )]
    public function updateOneById(Request $request, int $id, UpdateOneMovementByIdUseCase $useCase): SingleObjectViewModel
    {
        return $useCase->execute($id, $this->getRequestBody($request), $this->getTokenPayload($request));
    }

    #[Route('/movements/{id}/delete', name: 'movement_delete_one_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    #[ApiDoc\NotFoundResponse(
        description: 'No Movement found for the given id',
    )]
    public function deleteOneById(int $id, DeleteOneMovementByIdUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
