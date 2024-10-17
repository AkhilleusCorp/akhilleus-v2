<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\ExerciseDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\ExerciseDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\DeleteOneExerciseByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneExerciseByIdUseCaseTest extends AbstractIntegrationTest
{
    private DeleteOneExerciseByIdUseCase $useCase;
    private ExerciseDataModelProviderGateway $provider;

    public function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->container->get(ExerciseDataModelProviderGateway::class);

        $this->useCase = new DeleteOneExerciseByIdUseCase(
            $this->container->get(WorkoutDataModelProviderGateway::class),
            $this->provider,
            $this->container->get(ExerciseDataModelPersisterGateway::class)
        );
    }

    public function testExecuteForNonExistingWorkout(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Workout #666 cannot be found');

        $this->useCase->execute(666, 1);
    }

    public function testExecuteForNonExistingExercise(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Exercise #666 cannot be found');

        $this->useCase->execute(1, 666);
    }

    public function testExecuteSuccessful(): void
    {
        $exercise = $this->provider->getExerciseById(5);
        $this->assertNotNull($exercise);

        $this->useCase->execute(1, 5);

        $exercise = $this->provider->getExerciseById(5);
        $this->assertNull($exercise);
    }
}
