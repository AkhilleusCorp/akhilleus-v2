<?php

namespace App\Tests\integrations\UseCase\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;
use App\Domain\Factory\FilterModelFactory\Workout\WorkoutsFilterModelModelFactory;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleWorkoutItemViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleWorkoutViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\Workout\GetManyWorkoutUseCase;

final class GetManyWorkoutUseCaseTest extends AbstractIntegrationTest
{
    private GetManyWorkoutUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetManyWorkoutUseCase(
            $this->container->get(WorkoutDataModelProviderGateway::class),
            $this->container->get(WorkoutsFilterModelModelFactory::class),
            $this->container->get(MultipleWorkoutViewPresenter::class),
        );
    }

    public function testGetManyWorkoutWithNoFiltersForAdminDataProfile(): void
    {
        $view = $this->useCase->execute([], DataProfileRegistry::DATA_PROFILE_ADMIN);

        /** @var MultipleWorkoutItemViewModel[] $workouts */
        $workouts = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(GetManyWorkoutsFilterModel::DEFAULT_LIMIT, $workouts);
        $this->assertEquals(GetManyWorkoutsFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(GetManyWorkoutsFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testGetManyWorkoutWithNoFiltersForMemberDataProfile(): void
    {
        $view = $this->useCase->execute([]);

        /** @var MultipleWorkoutItemViewModel[] $workouts */
        $workouts = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(GetManyWorkoutsFilterModel::DEFAULT_LIMIT, $workouts);
        $this->assertEquals(GetManyWorkoutsFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(GetManyWorkoutsFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }
}