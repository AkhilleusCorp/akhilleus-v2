<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\Factory\FilterModelFactory\Workout\WorkoutsFilterModelModelFactory;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleWorkoutItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleWorkoutViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\GetManyWorkoutUseCase;

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

    public function testGetManyWorkoutWithNoFiltersForAdmin(): void
    {
        $view = $this->useCase->execute([], $this->getAdminTokenPayload());

        /** @var MultipleWorkoutItemDataViewModel[] $workouts */
        $workouts = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(AbstractFilterModel::DEFAULT_LIMIT, $workouts);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testGetManyWorkoutWithNoFiltersForMember(): void
    {
        $view = $this->useCase->execute([], $this->getMemberTokenPayload());

        /** @var MultipleWorkoutItemDataViewModel[] $workouts */
        $workouts = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(3, $workouts);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->lastPage);
    }

    public function testGetManyWorkoutWithFilterStatusesFilter(): void
    {
        $view = $this->useCase->execute(
            ['status' => WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS.','.WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED],
            $this->getAdminTokenPayload()
        );
        $this->assertCount(2, $view->data);

        $view = $this->useCase->execute(['status' => WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS], $this->getMemberTokenPayload());
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['status' => WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED], $this->getMemberTokenPayload());
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['status' => WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED], $this->getMemberTokenPayload());
        $this->assertCount(1, $view->data);
    }
}
