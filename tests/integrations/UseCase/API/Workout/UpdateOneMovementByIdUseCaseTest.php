<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\MovementDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\UpdateMovementSourceModelFactory;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Domain\Registry\Workout\MovementStatusRegistry;
use App\Infrastructure\Persister\Workout\MovementDataModelPersister;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\Repository\Workout\MovementDataModelRepository;
use App\Infrastructure\View\ViewModel\Workout\SingleMovementDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\UpdateOneMovementByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateOneMovementByIdUseCaseTest extends AbstractIntegrationTest
{
    private UpdateOneMovementByIdUseCase $useCase;
    private MovementDataModelRepository $movementDTORepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new UpdateOneMovementByIdUseCase(
            $this->container->get(UpdateMovementSourceModelFactory::class),
            $this->container->get(MovementDataModelFactory::class),
            $this->container->get(MovementDataModelProviderGateway::class),
            $this->container->get(MovementDataModelPersister::class),
            $this->container->get(SingleMovementViewPresenter::class),
        );

        $this->movementDTORepository = $this->container->get(MovementDataModelRepository::class);
    }

    public function testUpdateExistingMovement(): void
    {
        $movementId = 1;

        $movementPreUpdate = $this->movementDTORepository->getMovementById($movementId);
        $movementNamePreUpdate = $movementPreUpdate->name;

        $viewModel = $this->useCase->execute(
            $movementId,
            [
                'name' => 'New name for a new life',
                'status' => MovementStatusRegistry::MOVEMENT_STATUS_ACTIVE,
                'primaryMuscle' => 1, 'auxiliaryMuscles' => [2, 3], 'equipments' => [3, 4]],
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );
        /** @var SingleMovementDataViewModel $viewData */
        $viewData = $viewModel->data;

        $movementPostUpdate = $this->movementDTORepository->getMovementById($movementId);

        $this->assertEquals($movementPostUpdate->name, $viewData->name);
        $this->assertNotEquals($movementNamePreUpdate, $movementPostUpdate->name);
    }

    public function testUpdateNonExistingMovement(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666, ['name' => 'whatever']);
    }
}
