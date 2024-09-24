<?php

namespace App\Tests\integrations\UseCase\Workout;

use App\Domain\Factory\DataModelFactory\Workout\WorkoutDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\UpdateWorkoutSourceModelFactory;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Infrastructure\Persister\Workout\WorkoutDataModelPersister;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\Repository\Workout\WorkoutDataModelRepository;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\Workout\UpdateOneWorkoutByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateOneWorkoutByIdUseCaseTest extends AbstractIntegrationTest
{
    private UpdateOneWorkoutByIdUseCase $useCase;
    private WorkoutDataModelRepository $workoutDTORepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new UpdateOneWorkoutByIdUseCase(
            $this->container->get(UpdateWorkoutSourceModelFactory::class),
            $this->container->get(WorkoutDataModelFactory::class),
            $this->container->get(WorkoutDataModelProviderGateway::class),
            $this->container->get(WorkoutDataModelPersister::class),
            $this->container->get(SingleWorkoutViewPresenter::class),
        );

        $this->workoutDTORepository = $this->container->get(WorkoutDataModelRepository::class);
    }

    public function testUpdateExistingWorkout(): void
    {
        $workoutId = 1;

        $workoutPreUpdate = $this->workoutDTORepository->getWorkoutById($workoutId);
        $workoutNamePreUpdate = $workoutPreUpdate->name;

        $workoutReplied = $this->useCase->execute(
            $workoutId,
            ['name' => 'New name for a new life'],
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );
        $workoutPostUpdate = $this->workoutDTORepository->getWorkoutById($workoutId);

        $this->assertEquals($workoutPostUpdate->name, $workoutReplied->name);
        $this->assertNotEquals($workoutNamePreUpdate, $workoutPostUpdate->name);
        $this->assertEquals($workoutPreUpdate->status, $workoutReplied->status);
        $this->assertEquals($workoutPostUpdate->visibility, $workoutReplied->visibility);
    }

    public function testUpdateNonExistingWorkout(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666, ['name' => 'whatever']);
    }
}