<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\ExerciseGroupDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\DeleteOneExerciseGroupByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneExerciseGroupByIdUseCaseTest extends AbstractIntegrationTest
{
    private DeleteOneExerciseGroupByIdUseCase $useCase;
    private ExerciseGroupDataModelProviderGateway $provider;

    public function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->container->get(ExerciseGroupDataModelProviderGateway::class);

        $this->useCase = new DeleteOneExerciseGroupByIdUseCase(
            $this->provider,
            $this->container->get(ExerciseGroupDataModelPersisterGateway::class)
        );
    }

    public function testExecuteForNonExistingGroup(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("Exercise group #666 cannot be found");

        $this->useCase->execute(1, 666);
    }

    public function testExecuteForGroupNotInGivenWorkout(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("Exercise group #4 is not part of Workout #3");

        $this->useCase->execute(3, 4);
    }

    public function testExecuteSuccessful(): void
    {
        $group = $this->provider->getExerciseGroupById(4);
        $this->assertNotNull($group);

        $this->useCase->execute(1, 4);

        $group = $this->provider->getExerciseGroupById(4);
        $this->assertNull($group);
    }
}