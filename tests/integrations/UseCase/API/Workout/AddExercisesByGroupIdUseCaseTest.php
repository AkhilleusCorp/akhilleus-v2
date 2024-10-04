<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\ExerciseDataModelFactory;
use App\Domain\Gateway\Persister\Workout\ExerciseGroupDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\View\ViewPresenter\Workout\SingleExerciseGroupViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\AddExercisesByGroupIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AddExercisesByGroupIdUseCaseTest extends AbstractIntegrationTest
{
    private AddExercisesByGroupIdUseCase $useCase;
    private ExerciseGroupDataModelProviderGateway $provider;

    public function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->container->get(ExerciseGroupDataModelProviderGateway::class);

        $this->useCase = new AddExercisesByGroupIdUseCase(
            $this->provider,
            $this->container->get(MovementDataModelProviderGateway::class),
            $this->container->get(ExerciseDataModelFactory::class),
            $this->container->get(ExerciseGroupDataModelPersisterGateway::class),
            $this->container->get(SingleExerciseGroupViewPresenter::class),
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
        $this->assertCount(6, $group->exercises);

        $result = $this->useCase->execute(1, 4);
        $this->assertCount(7, $result->data->exercises);

        $group = $this->provider->getExerciseGroupById(4);
        $this->assertCount(7, $group->exercises);
    }
}