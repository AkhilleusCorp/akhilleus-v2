<?php

namespace App\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\ExerciseGroupDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneExerciseGroupByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly ExerciseGroupDataModelProviderGateway $groupProvider,
        private readonly ExerciseGroupDataModelPersisterGateway $groupPersister,
    ) {
    }

    public function execute(int $workoutId, int $groupId): void
    {
        $group = $this->groupProvider->getExerciseGroupById($groupId);
        if (null === $group) {
            throw new NotFoundHttpException("Exercise group #$groupId cannot be found");
        }

        if ($workoutId !== $group->workout->id) {
            throw new NotFoundHttpException("Exercise group #$groupId is not part of Workout #$workoutId");
        }

        $this->groupPersister->remove($group);
    }
}
