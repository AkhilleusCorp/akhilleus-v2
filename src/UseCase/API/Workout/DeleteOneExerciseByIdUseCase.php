<?php

namespace App\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\ExerciseDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\ExerciseDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneExerciseByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDataModelProviderGateway $workoutProvider,
        private readonly ExerciseDataModelProviderGateway $exerciseProvider,
        private readonly ExerciseDataModelPersisterGateway $exercisePersister,
    ) {
    }

    public function execute(int $workoutId, int $exerciseId): void
    {
        $workout = $this->workoutProvider->getWorkoutById($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException("Workout #$workoutId cannot be found");
        }

        $exercise = $this->exerciseProvider->getExerciseById($exerciseId);
        if (null === $exercise) {
            throw new NotFoundHttpException("Exercise #$exerciseId cannot be found");
        }

        $this->exercisePersister->remove($exercise);
    }
}
