<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\Workout\SingleMovementDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\GetOneMovementByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneMovementByIdUseCaseTest extends AbstractIntegrationTest
{
    private GetOneMovementByIdUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetOneMovementByIdUseCase(
            $this->container->get(MovementDataModelProviderGateway::class),
            $this->container->get(SingleMovementViewPresenter::class)
        );
    }

    public function testGetOneUserForAdminDataProfile(): void
    {
        $movementId = 1;
        $viewModel = $this->useCase->execute($movementId, DataProfileRegistry::DATA_PROFILE_ADMIN);
        /** @var SingleMovementDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($movementId, $viewData->id);
        $this->assertEquals('Bench press', $viewData->name);
        $this->assertEquals(5, $viewData->primaryMuscle->id);
        $this->assertEquals([], $viewData->auxiliaryMuscles);
        $this->assertEquals(1, $viewData->equipments[0]->id);
        $this->assertEquals(3, $viewData->equipments[1]->id);
    }

    public function testGetOneUserForMemberDataProfile(): void
    {
        $movementId = 1;
        $viewModel = $this->useCase->execute($movementId);
        /** @var SingleMovementDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($movementId, $viewData->id);
        $this->assertEquals('Bench press', $viewData->name);
        $this->assertEquals(5, $viewData->primaryMuscle->id);
        $this->assertEquals([], $viewData->auxiliaryMuscles);
        $this->assertEquals(1, $viewData->equipments[0]->id);
        $this->assertEquals(3, $viewData->equipments[1]->id);
    }

    public function testGetOneNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Movement #666 cannot be found');

        $this->useCase->execute(666, DataProfileRegistry::DATA_PROFILE_ADMIN);
    }
}
