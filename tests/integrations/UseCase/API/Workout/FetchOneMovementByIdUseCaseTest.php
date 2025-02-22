<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\View\ViewModel\Workout\SingleMovementDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\FetchOneMovementByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class FetchOneMovementByIdUseCaseTest extends AbstractIntegrationTest
{
    private FetchOneMovementByIdUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new FetchOneMovementByIdUseCase(
            $this->container->get(MovementDataModelProviderGateway::class),
            $this->container->get(SingleMovementViewPresenter::class)
        );
    }

    public function testFetchOneUserForAdmin(): void
    {
        $movementId = 1;
        $viewModel = $this->useCase->execute($movementId, $this->getAdminTokenPayload());
        /** @var SingleMovementDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($movementId, $viewData->id);
        $this->assertEquals('Bench press', $viewData->name);
        $this->assertEquals(5, $viewData->primaryMuscle->id);
        $this->assertEquals([], $viewData->auxiliaryMuscles);
        $this->assertEquals(1, $viewData->equipments[0]->id);
        $this->assertEquals(3, $viewData->equipments[1]->id);
    }

    public function testFetchOneUserForMember(): void
    {
        $movementId = 1;
        $viewModel = $this->useCase->execute($movementId, $this->getMemberTokenPayload());
        /** @var SingleMovementDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($movementId, $viewData->id);
        $this->assertEquals('Bench press', $viewData->name);
        $this->assertEquals(5, $viewData->primaryMuscle->id);
        $this->assertEquals([], $viewData->auxiliaryMuscles);
        $this->assertEquals(1, $viewData->equipments[0]->id);
        $this->assertEquals(3, $viewData->equipments[1]->id);
    }

    public function testFetchOneNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Movement #666 cannot be found');

        $this->useCase->execute(666, $this->getAdminTokenPayload());
    }
}
