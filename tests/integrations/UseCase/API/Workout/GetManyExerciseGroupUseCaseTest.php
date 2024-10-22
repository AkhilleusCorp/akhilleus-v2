<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleExerciseGroupViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\GetManyExerciseGroupUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetManyExerciseGroupUseCaseTest extends AbstractIntegrationTest
{
    private GetManyExerciseGroupUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetManyExerciseGroupUseCase(
            $this->container->get(WorkoutDataModelProviderGateway::class),
            $this->container->get(ExerciseGroupDataModelProviderGateway::class),
            $this->container->get(MultipleExerciseGroupViewPresenter::class),
        );
    }

    public function testExecuteForNonExistingWorkout(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666, $this->getMemberTokenPayload());
    }

    public function testExecuteForWorkoutWithoutGroup(): void
    {
        $result = $this->useCase->execute(25, $this->getMemberTokenPayload());

        $this->assertCount(0, $result->data);
        $this->assertEmpty($result->extra);
    }

    public function testExecuteForWorkoutWithGroups(): void
    {
        $result = $this->useCase->execute(1, $this->getMemberTokenPayload());

        $this->assertCount(5, $result->data);
        $this->assertEmpty($result->extra);
    }
}
