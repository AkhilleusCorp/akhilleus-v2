<?php

namespace App\Infrastructure\Controller\API\Equipment;

use App\Domain\DTO\FilterModel\Equipment\GetManyEquipmentsFilterModel;
use App\Domain\DTO\SourceModel\Equipment\CreateEquipmentSourceModel;
use App\Domain\DTO\SourceModel\Equipment\UpdateEquipmentSourceModel;
use App\Domain\Factory\DataModelFactory\DataModelFactoryInterface;
use App\Domain\Factory\DataModelFactory\Equipment\EquipmentDataModelFactory;
use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\Controller\API\GenericAPIControllerInterface;
use App\Infrastructure\View\ViewModel\Equipment\SingleEquipmentDataViewModel;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\UseCase\API\GenericCreateOneUseCase;
use App\UseCase\API\GenericDeleteOneByIdUseCase;
use App\UseCase\API\GenericGetManyUseCase;
use App\UseCase\API\GenericGetOneByIdUseCase;
use App\UseCase\API\GenericUpdateOneByIdUseCase;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[OA\Tag('EQUIPMENTS')]
final class EquipmentController extends AbstractAPIController implements GenericAPIControllerInterface
{
    #[Route('/equipments', name:'equipment_get_many', methods: ['GET'])]
    public function getMany(
        Request $request,
        GenericGetManyUseCase $useCase,
        EquipmentDataModelProviderGateway|GenericDataModelProviderGateway $providerGateway
    ): MultipleObjectViewModel {
        return $useCase->execute($request->query->all(), new GetManyEquipmentsFilterModel(), $providerGateway);
    }

    #[Route('/equipments/{id}', name:'equipment_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneById(
        int $id,
        GenericGetOneByIdUseCase $useCase,
        EquipmentDataModelProviderGateway|GenericDataModelProviderGateway $providerGateway
    ): SingleObjectViewModel {
        return $useCase->execute($id, $providerGateway, new SingleEquipmentDataViewModel());
    }
    #[Route('/equipments', name:'equipments_create_one', methods: ['POST'])]
    public function createOne(
        Request $request,
        GenericCreateOneUseCase $useCase,
        EquipmentDataModelFactory|DataModelFactoryInterface $dataModelFactory
    ): SingleObjectViewModel {
        return $useCase->execute(
            json_decode($request->getContent(), true),
            new CreateEquipmentSourceModel(),
            $dataModelFactory,
            new SingleEquipmentDataViewModel()
        );
    }

    #[Route('/users/{id}', name:'user_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    public function updateOneById(
        int $id,
        Request $request,
        GenericUpdateOneByIdUseCase $useCase,
        EquipmentDataModelProviderGateway|GenericDataModelProviderGateway $providerGateway,
        EquipmentDataModelFactory|DataModelFactoryInterface $dataModelFactory
    ): SingleObjectViewModel {
        return $useCase->execute(
            $id,
            json_decode($request->getContent(), true),
            $providerGateway,
            new UpdateEquipmentSourceModel(),
            $dataModelFactory,
            new SingleEquipmentDataViewModel()
        );
    }

    #[Route('/equipments/{id}', name:'equipment_delete_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteOnById(
        int $id,
        GenericDeleteOneByIdUseCase $useCase,
        EquipmentDataModelProviderGateway|GenericDataModelProviderGateway $providerGateway
    ): JsonResponse {
        $useCase->execute($id, $providerGateway);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}