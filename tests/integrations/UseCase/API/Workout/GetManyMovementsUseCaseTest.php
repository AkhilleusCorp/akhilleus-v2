<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\Factory\FilterModelFactory\FilterModelFactory;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleMovementItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleMovementViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\GetManyMovementsUseCase;

final class GetManyMovementsUseCaseTest extends AbstractIntegrationTest
{
    private GetManyMovementsUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetManyMovementsUseCase(
            $this->container->get(MovementDataModelProviderGateway::class),
            $this->container->get(FilterModelFactory::class),
            $this->container->get(MultipleMovementViewPresenter::class),
        );
    }

    public function testGetManyMovementWithNoFiltersForAdmin(): void
    {
        $view = $this->useCase->execute([], $this->getAdminTokenPayload());

        /** @var MultipleMovementItemDataViewModel[] $movements */
        $movements = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(6, $movements);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->lastPage);
    }

    public function testGetManyMovementWithNoFiltersForMember(): void
    {
        $view = $this->useCase->execute([], $this->getMemberTokenPayload());

        /** @var MultipleMovementItemDataViewModel[] $movements */
        $movements = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(6, $movements);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->lastPage);
    }
}
