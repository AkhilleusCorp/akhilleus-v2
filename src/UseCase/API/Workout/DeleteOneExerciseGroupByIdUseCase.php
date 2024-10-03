<?php

namespace App\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\ExerciseGroupDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneExerciseGroupByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDataModelProviderGateway  $workoutProvider,
        private readonly ExerciseGroupDataModelProviderGateway $groupProvider,
        private readonly ExerciseGroupDataModelPersisterGateway $groupPersister,
    ) {

    }

    public function execute(int $workoutId, int $groupId): void
    {
        $workout = $this->workoutProvider->getWorkoutById($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException("Workout #$workoutId cannot be found");
        }

        $group = $this->groupProvider->getExerciseGroupById($groupId);
        if (null === $group) {
            throw new NotFoundHttpException("Exercise group #$groupId cannot be found");
        }

        $this->groupPersister->remove($group);
    }
}