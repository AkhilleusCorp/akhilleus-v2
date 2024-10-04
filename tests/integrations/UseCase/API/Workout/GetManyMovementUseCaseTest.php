<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Factory\FilterModelFactory\Workout\MovementsFilterModelModelFactory;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleMovementItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleMovementViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\GetManyMovementUseCase;

final class GetManyMovementUseCaseTest extends AbstractIntegrationTest
{
    private GetManyMovementUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetManyMovementUseCase(
            $this->container->get(MovementDataModelProviderGateway::class),
            $this->container->get(MovementsFilterModelModelFactory::class),
            $this->container->get(MultipleMovementViewPresenter::class),
        );
    }

    public function testGetManyMovementWithNoFiltersForAdminDataProfile(): void
    {
        $view = $this->useCase->execute([], DataProfileRegistry::DATA_PROFILE_ADMIN);

        /** @var MultipleMovementItemDataViewModel[] $movements */
        $movements = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(6, $movements);
        $this->assertEquals(GetManyMovementsFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(GetManyMovementsFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(GetManyMovementsFilterModel::DEFAULT_PAGE, $pagination->lastPage);
    }

    public function testGetManyMovementWithNoFiltersForMemberDataProfile(): void
    {
        $view = $this->useCase->execute([]);

        /** @var MultipleMovementItemDataViewModel[] $movements */
        $movements = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(6, $movements);
        $this->assertEquals(GetManyMovementsFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(GetManyMovementsFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(GetManyMovementsFilterModel::DEFAULT_PAGE, $pagination->lastPage);
    }
}