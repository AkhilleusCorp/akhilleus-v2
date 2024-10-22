<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\Factory\FilterModelFactory\Workout\WorkoutsFilterModelModelFactory;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Registry\DataProfileRegistry;
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

    public function testGetManyWorkoutWithNoFiltersForAdminDataProfile(): void
    {
        $payload = new TokenPayloadDTO();
        $payload->userId = 3;
        $payload->userType = UserTypeRegistry::USER_TYPE_ADMIN;

        $view = $this->useCase->execute(
            [],
            $payload,
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );

        /** @var MultipleWorkoutItemDataViewModel[] $workouts */
        $workouts = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(AbstractFilterModel::DEFAULT_LIMIT, $workouts);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testGetManyWorkoutWithNoFiltersForMemberDataProfile(): void
    {
        $payload = new TokenPayloadDTO();
        $payload->userId = 1;
        $payload->userType = UserTypeRegistry::USER_TYPE_MEMBER;

        $view = $this->useCase->execute([], $payload);

        /** @var MultipleWorkoutItemDataViewModel[] $workouts */
        $workouts = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(AbstractFilterModel::DEFAULT_LIMIT, $workouts);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testGetManyWorkoutWithFilterStatusesFilter(): void
    {
        $payload = new TokenPayloadDTO();
        $payload->userId = 3;
        $payload->userType = UserTypeRegistry::USER_TYPE_ADMIN;

        $view = $this->useCase->execute(
            ['status' => WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS],
            $payload,
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );
        $this->assertCount(1, $view->data);

        $payload = new TokenPayloadDTO();
        $payload->userId = 1;
        $payload->userType = UserTypeRegistry::USER_TYPE_MEMBER;

        $view = $this->useCase->execute(['status' => WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED], $payload);
        $this->assertCount(25, $view->data);

        $view = $this->useCase->execute(['status' => WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED], $payload);
        $this->assertCount(1, $view->data);
    }
}
