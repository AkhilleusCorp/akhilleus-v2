<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Domain\Registry\Workout\WorkoutVisibilityRegistry;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutDataViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\GetOneWorkoutByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneWorkoutByIdUseCaseTest extends AbstractIntegrationTest
{
    private GetOneWorkoutByIdUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetOneWorkoutByIdUseCase(
            $this->container->get(WorkoutDataModelProviderGateway::class),
            $this->container->get(SingleWorkoutViewPresenter::class)
        );
    }

    public function testGetOneUserForAdminDataProfile(): void
    {
        $workoutId = 1;
        $viewModel = $this->useCase->execute($workoutId, DataProfileRegistry::DATA_PROFILE_ADMIN);
        /** @var SingleWorkoutDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($workoutId, $viewData->id);
        $this->assertEquals('In Progress Private', $viewData->name);
        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $viewData->status);
        $this->assertEquals(WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PRIVATE, $viewData->visibility);
    }

    public function testGetOneUserForMemberDataProfile(): void
    {
        $workoutId = 1;
        $viewModel = $this->useCase->execute($workoutId);
        /** @var SingleWorkoutDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($workoutId, $viewData->id);
        $this->assertEquals('In Progress Private', $viewData->name);
        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $viewData->status);
        $this->assertEquals(WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PRIVATE, $viewData->visibility);
    }

    public function testGetOneNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Workout #666 cannot be found');

        $this->useCase->execute(666, DataProfileRegistry::DATA_PROFILE_ADMIN);
    }
}
