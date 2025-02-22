<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyMusclesFilterModel;
use App\Domain\DTO\SourceModel\Workout\CreateMuscleSourceModel;
use App\Domain\DTO\SourceModel\Workout\UpdateMuscleSourceModel;
use App\Domain\Factory\DataModelFactory\Workout\MuscleDataModelFactory;
use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;
use App\Infrastructure\ApiDoc;
use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleMuscleItemDataViewModel;
use App\Infrastructure\View\ViewModel\Workout\SingleMuscleDataViewModel;
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

#[ApiDoc\DocSection('MUSCLES')]
final class MuscleController extends AbstractAPIController
{
    #[Route('/muscles', name: 'muscle_get_many', methods: ['GET'])]
    #[ApiDoc\GetParameters(dataClass: GetManyMusclesFilterModel::class)]
    #[ApiDoc\MultipleObjectResponse(
        response: 200,
        description: 'Successfully returns a list of Muscles',
        dataClass: MultipleMuscleItemDataViewModel::class,
    )]
    public function fetchMany(
        Request $request,
        GenericFetchManyUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
    ): MultipleObjectViewModel {
        return $useCase->execute($this->getRequestParams($request), new GetManyMusclesFilterModel(), $providerGateway);
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
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully returns the details of a Muscle',
        dataClass: SingleMuscleDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Muscle found for the given id',
    )]
    public function fetchOneById(
        int $id,
        GenericFetchOneByIdUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
    ): SingleObjectViewModel {
        return $useCase->execute($id, $providerGateway, new SingleMuscleDataViewModel());
    }

    #[Route('/muscles', name: 'muscles_create_one', methods: ['POST'])]
    #[ApiDoc\PostParameters(dataClass: CreateMuscleSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully create a Muscle',
        dataClass: SingleMuscleDataViewModel::class,
    )]
    public function createOne(
        Request $request,
        GenericCreateOneUseCase $useCase,
        MuscleDataModelFactory $dataModelFactory,
    ): SingleObjectViewModel {
        return $useCase->execute(
            $this->getRequestBody($request),
            new CreateMuscleSourceModel(),
            $dataModelFactory,
            new SingleMuscleDataViewModel()
        );
    }

    #[Route('/muscles/{id}', name: 'muscle_update_one_by_id', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[ApiDoc\PostParameters(dataClass: UpdateMuscleSourceModel::class)]
    #[ApiDoc\SingleObjectResponse(
        response: 200,
        description: 'Successfully edit the details of a Muscle',
        dataClass: SingleMuscleDataViewModel::class,
    )]
    #[ApiDoc\NotFoundResponse(
        description: 'No Muscle found for the given id',
    )]
    public function updateOneById(
        int $id,
        Request $request,
        GenericUpdateOneByIdUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
        MuscleDataModelFactory $dataModelFactory,
    ): SingleObjectViewModel {
        return $useCase->execute(
            $id,
            $this->getRequestBody($request),
            $providerGateway,
            new UpdateMuscleSourceModel(),
            $dataModelFactory,
            new SingleMuscleDataViewModel()
        );
    }

    #[Route('/muscles/{id}', name: 'muscle_delete_by_id', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    #[ApiDoc\NotFoundResponse(
        description: 'No Muscle found for the given id',
    )]
    public function deleteOnById(
        int $id,
        GenericDeleteOneByIdUseCase $useCase,
        MuscleDataModelProviderGateway $providerGateway,
    ): JsonResponse {
        $useCase->execute($id, $providerGateway);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
