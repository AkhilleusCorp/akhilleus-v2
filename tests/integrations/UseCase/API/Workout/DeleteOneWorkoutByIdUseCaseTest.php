<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\Repository\Workout\WorkoutDataModelRepository;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\DeleteOneWorkoutByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneWorkoutByIdUseCaseTest extends AbstractIntegrationTest
{
    private DeleteOneWorkoutByIdUseCase $useCase;
    private WorkoutDataModelRepository $workoutDTORepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new DeleteOneWorkoutByIdUseCase(
            $this->container->get(WorkoutDataModelProviderGateway::class),
            $this->container->get(WorkoutDataModelPersisterGateway::class)
        );

        $this->workoutDTORepository = $this->container->get(WorkoutDataModelRepository::class);
    }

    public function testDeleteExistingWorkout(): void
    {
        $workoutId = 1;

        $countBeforeDelete = $this->workoutDTORepository->countWorkoutsByFilterModel(null);
        $this->useCase->execute($workoutId);
        $countAfterDelete = $this->workoutDTORepository->countWorkoutsByFilterModel(null);
        $workoutPostDelete = $this->workoutDTORepository->getWorkoutById($workoutId);

        $this->assertEquals($countBeforeDelete - 1, $countAfterDelete);
        $this->assertNull($workoutPostDelete);
    }

    public function testDeleteNonExistingWorkout(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666);
    }
}
