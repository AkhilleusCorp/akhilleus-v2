<?php

namespace App\Tests\integrations\UseCase\Workout;

use App\Domain\Gateway\Provider\Workout\WorkoutDTOProviderGateway;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Domain\Registry\Workout\WorkoutVisibilityRegistry;
use App\Infrastructure\Exception\InvalidDataProfileException;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\Workout\GetOneWorkoutByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneWorkoutByIdUseCaseTest extends AbstractIntegrationTest
{
    private GetOneWorkoutByIdUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetOneWorkoutByIdUseCase(
            $this->container->get(WorkoutDTOProviderGateway::class),
            $this->container->get(SingleWorkoutViewPresenter::class)
        );
    }

    public function testGetOneUserForAdminDataProfile(): void
    {
        $workoutId = 1;
        $viewModel = $this->useCase->execute($workoutId, DataProfileRegistry::DATA_PROFILE_ADMIN);

        $this->assertEquals($workoutId, $viewModel->id);
        $this->assertEquals('InProgressPrivate', $viewModel->name);
        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $viewModel->status);
        $this->assertEquals(WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PRIVATE, $viewModel->visibility);
    }

    public function testGetOneUserForMemberDataProfile(): void
    {
        $workoutId = 1;
        $viewModel = $this->useCase->execute($workoutId);

        $this->assertEquals($workoutId, $viewModel->id);
        $this->assertEquals('InProgressPrivate', $viewModel->name);
        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $viewModel->status);
        $this->assertEquals(WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PRIVATE, $viewModel->visibility);
    }

    public function testGetOneUserForUnknownDataProfile(): void
    {
        $this->expectException(InvalidDataProfileException::class);

        $this->useCase->execute(2, 'unknown_data_profile');
    }

    public function testGetOneNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("Workout #666 cannot be found");

        $this->useCase->execute(666, DataProfileRegistry::DATA_PROFILE_ADMIN);
    }
}