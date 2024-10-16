<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyMusclesFilterModel;
use App\Domain\DTO\SourceModel\Workout\CreateMuscleSourceModel;
use App\Domain\DTO\SourceModel\Workout\UpdateMuscleSourceModel;
use App\Domain\Factory\DataModelFactory\Workout\MuscleDataModelFactory;
use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\SingleMuscleDataViewModel;
use App\UseCase\API\GenericCreateOneUseCase;
use App\UseCase\API\GenericDeleteOneByIdUseCase;
use App\UseCase\API\GenericGetDropdownableUseCase;
use App\UseCase\API\GenericGetManyUseCase;
use App\UseCase\API\GenericGetOneByIdUseCase;
use App\UseCase\API\GenericUpdateOneByIdUseCase;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[OA\Tag('EQUIPMENTS')]
final class MuscleController extends AbstractAPIController
{
    #[Route('/muscles', name: 'muscle_get_many', methods: ['GET'])]
    public function getMany(
        Request $request,
        GenericGetManyUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
    ): MultipleObjectViewModel {
        return $useCase->execute($request->query->all(), new GetManyMusclesFilterModel(), $providerGateway);
    }

    /**
     * @return array<string, string>
     */
    #[Route('/muscles/dropdownable', name: 'muscle_get_dropdownable', methods: ['GET'])]
    public function getDropdownable(
        GenericGetDropdownableUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
    ): array {
        return $useCase->execute('name', $providerGateway);
    }

    #[Route('/muscles/{id}', name: 'muscle_get_one_by_id', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneById(
        int $id,
        GenericGetOneByIdUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
    ): SingleObjectViewModel {
        return $useCase->execute($id, $providerGateway, new SingleMuscleDataViewModel());
    }

    #[Route('/muscles', name: 'muscles_create_one', methods: ['POST'])]
    public function createOne(
        Request $request,
        GenericCreateOneUseCase $useCase,
        MuscleDataModelFactory $dataModelFactory,
    ): SingleObjectViewModel {
        return $useCase->execute(
            json_decode($request->getContent(), true),
            new CreateMuscleSourceModel(),
            $dataModelFactory,
            new SingleMuscleDataViewModel()
        );
    }

    #[Route('/muscles/{id}', name: 'muscle_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    public function updateOneById(
        int $id,
        Request $request,
        GenericUpdateOneByIdUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
        MuscleDataModelFactory $dataModelFactory,
    ): SingleObjectViewModel {
        return $useCase->execute(
            $id,
            json_decode($request->getContent(), true),
            $providerGateway,
            new UpdateMuscleSourceModel(),
            $dataModelFactory,
            new SingleMuscleDataViewModel()
        );
    }

    #[Route('/muscles/{id}', name: 'muscle_delete_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteOnById(
        int $id,
        GenericDeleteOneByIdUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
    ): JsonResponse {
        $useCase->execute($id, $providerGateway);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
