<?php

namespace App\Infrastructure\Controller\Api\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyEquipmentsFilterModel;
use App\Domain\Gateway\Provider\Workout\EquipmentDataModelProviderGateway;
use App\Infrastructure\Controller\Api\AbstractAPIController;
use App\Infrastructure\Repository\Workout\EquipmentDataModelRepository;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\SingleEquipmentDataViewModel;
use App\UseCase\API\GenericGetManyUseCase;
use App\UseCase\API\GenericGetOneByIdUseCase;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[OA\Tag('EQUIPMENTS')]
final class EquipmentController extends AbstractAPIController
{
    #[Route('/equipments', name:'equipment_get_many', methods: ['GET'])]
    public function getMany(Request $request, GenericGetManyUseCase $useCase, EquipmentDataModelProviderGateway $providerGateway): MultipleObjectViewModel
    {
        return $useCase->execute($request->query->all(), new GetManyEquipmentsFilterModel(), $providerGateway);
    }

    #[Route('/equipments/{id}', name:'equipment_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneById(int $id, GenericGetOneByIdUseCase $useCase, EquipmentDataModelProviderGateway $providerGateway): SingleObjectViewModel
    {
        return $useCase->execute($id, $providerGateway, new SingleEquipmentDataViewModel());
    }
}