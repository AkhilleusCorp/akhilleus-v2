<?php

namespace App\Infrastructure\Controller\API\Equipment;

use App\Domain\DTO\FilterModel\Equipment\GetManyEquipmentsFilterModel;
use App\Domain\DTO\SourceModel\Equipment\CreateEquipmentSourceModel;
use App\Domain\DTO\SourceModel\Equipment\UpdateEquipmentSourceModel;
use App\Domain\Factory\DataModelFactory\Equipment\EquipmentDataModelFactory;
use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\Infrastructure\ApiDoc;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\Equipment\MultipleEquipmentItemDataViewModel;
use App\Infrastructure\View\ViewModel\Equipment\SingleEquipmentDataViewModel;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\UseCase\API\GenericCreateOneUseCase;
use App\UseCase\API\GenericDeleteOneByIdUseCase;
use App\UseCase\API\GenericFetchManyUseCase;
use App\UseCase\API\GenericFetchOneByIdUseCase;
use App\UseCase\API\GenericGetDropdownableUseCase;
use App\UseCase\API\GenericUpdateOneByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[ApiDoc\DocSection('EQUIPMENTS')]
final class EquipmentController extends AbstractAPIController
{
    #[Route('/equipments/fetch', name: 'equipment_get_many', methods: ['POST'])]
    #[ApiDoc\RequestBodyParameters(dataClass: GetManyEquipmentsFilterModel::class)]
    #[ApiDoc\MultipleObjectResponse(
        response: 200,
        description: 'Successfully returns a list of Equipments',
        dataClass: MultipleEquipmentItemDataViewModel::class,
    )]
    public function fetchMany(
        Request $request,
        GenericFetchManyUseCase $useCase,
        EquipmentDataModelProviderGateway $providerGateway,
    ): MultipleObjectViewModel {
        return $useCase->execute($this->getRequestBody($request), new GetManyEquipmentsFilterModel(), $providerGateway);
    }

    /**
     * @return array<string, string>
     */
    #[Route('/equipments/dropdownable', name: 'equipment_get_dropdownable', methods: ['GET'])]
    public function getDropdownable(
        GenericGetDropdownableUseCase $useCase,
        EquipmentDataModelProviderGateway $providerGateway,
    ): array {
        return $useCase->execute('name', $providerGateway);
    }

    #[Route('/equipments/{id}/fetch', name: 'equipment_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully returns the details of an Equipment',
        dataClass: SingleEquipmentDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Equipment found for the given id',
    )]
    public function fetchOneById(
        int $id,
        GenericFetchOneByIdUseCase $useCase,
        EquipmentDataModelProviderGateway $providerGateway,
    ): SingleObjectViewModel {
        return $useCase->execute($id, $providerGateway, new SingleEquipmentDataViewModel());
    }

    #[Route('/equipments/create', name: 'equipments_create_one', methods: ['POST'])]
    #[ApiDoc\RequestBodyParameters(dataClass: CreateEquipmentSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully create an Equipment',
        dataClass: SingleEquipmentDataViewModel::class,
    )]
    public function createOne(
        Request $request,
        GenericCreateOneUseCase $useCase,
        EquipmentDataModelFactory $dataModelFactory,
    ): SingleObjectViewModel {
        return $useCase->execute(
            $this->getRequestBody($request),
            new CreateEquipmentSourceModel(),
            $dataModelFactory,
            new SingleEquipmentDataViewModel()
        );
    }

    #[Route('/equipments/{id}/update', name: 'equipment_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[ApiDoc\RequestBodyParameters(dataClass: UpdateEquipmentSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully edit the details of an Equipment',
        dataClass: SingleEquipmentDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Equipment found for the given id',
    )]
    public function updateOneById(
        int $id,
        Request $request,
        GenericUpdateOneByIdUseCase $useCase,
        EquipmentDataModelProviderGateway $providerGateway,
        EquipmentDataModelFactory $dataModelFactory,
    ): SingleObjectViewModel {
        return $useCase->execute(
            $id,
            $this->getRequestBody($request),
            $providerGateway,
            new UpdateEquipmentSourceModel(),
            $dataModelFactory,
            new SingleEquipmentDataViewModel()
        );
    }

    #[Route('/equipments/{id}/delete', name: 'equipment_delete_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    #[ApiDoc\NotFoundResponse(
        description: 'No Equipment found for the given id',
    )]
    public function deleteOnById(
        int $id,
        GenericDeleteOneByIdUseCase $useCase,
        EquipmentDataModelProviderGateway $providerGateway,
    ): JsonResponse {
        $useCase->execute($id, $providerGateway);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
