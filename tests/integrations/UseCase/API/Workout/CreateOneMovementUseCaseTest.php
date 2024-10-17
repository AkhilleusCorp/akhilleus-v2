<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\MovementDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateMovementSourceModelFactory;
use App\Domain\Gateway\Persister\Workout\MovementDataModelPersisterGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\Workout\SingleMovementDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\CreateOneMovementUseCase;

final class CreateOneMovementUseCaseTest extends AbstractIntegrationTest
{
    private CreateOneMovementUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new CreateOneMovementUseCase(
            $this->container->get(CreateMovementSourceModelFactory::class),
            $this->container->get(MovementDataModelFactory::class),
            $this->container->get(MovementDataModelPersisterGateway::class),
            $this->container->get(SingleMovementViewPresenter::class),
        );
    }

    public function testCreateOneForAdminDataProfile(): void
    {
        $name = 'New movement for admin';
        $viewModel = $this->useCase->execute(
            ['name' => $name, 'primaryMuscle' => 1, 'auxiliaryMuscles' => [2, 3], 'equipments' => [3, 4]],
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );
        /** @var SingleMovementDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($name, $viewData->name);
    }

    public function testCreateOneForMemberDataProfile(): void
    {
        $name = 'New movement for member';
        $viewModel = $this->useCase->execute(
            ['name' => $name, 'primaryMuscle' => 1, 'auxiliaryMuscles' => [2, 3], 'equipments' => [3, 4]],
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );
        /** @var SingleMovementDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($name, $viewData->name);
    }
}
