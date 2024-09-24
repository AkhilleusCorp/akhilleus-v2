<?php

namespace App\Tests\integrations\UseCase\Workout;

use App\Domain\Factory\DataModelFactory\Workout\WorkoutDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateWorkoutSourceModelFactory;
use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Domain\Registry\Workout\WorkoutVisibilityRegistry;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\Workout\CreateOneWorkoutUseCase;

final class CreateOneWorkoutUseCaseTest extends AbstractIntegrationTest
{
    private CreateOneWorkoutUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new CreateOneWorkoutUseCase(
            $this->container->get(CreateWorkoutSourceModelFactory::class),
            $this->container->get(WorkoutDataModelFactory::class),
            $this->container->get(WorkoutDataModelPersisterGateway::class),
            $this->container->get(SingleWorkoutViewPresenter::class),
        );
    }

    public function testCreateOneForAdminDataProfile(): void
    {
        $name = 'New workout for admin';
        $viewModel = $this->useCase->execute(
            ['name' => $name],
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );

        $this->assertEquals($name, $viewModel->name);
        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $viewModel->status);
        $this->assertEquals(WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_FRIENDS, $viewModel->visibility);
    }

    public function testCreateOneForMemberDataProfile(): void
    {
        $name = 'New workout for member';
        $viewModel = $this->useCase->execute(
            ['name' => $name]
        );

        $this->assertEquals($name, $viewModel->name);
        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS, $viewModel->status);
        $this->assertEquals(WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_FRIENDS, $viewModel->visibility);
    }

    public function testCreateOnePlannedForSpecificClient(): void
    {
        $name = 'New workout for member';
        $viewModel = $this->useCase->execute(
            [
                'name' => $name,
                'status' => WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED,
                'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_SPECIFIC_CLIENT
            ]
        );

        $this->assertEquals($name, $viewModel->name);
        $this->assertEquals(WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED, $viewModel->status);
        $this->assertEquals(WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_SPECIFIC_CLIENT, $viewModel->visibility);
    }
}