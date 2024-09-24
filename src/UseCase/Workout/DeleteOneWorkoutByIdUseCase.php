<?php

namespace App\UseCase\Workout;

use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneWorkoutByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDataModelProviderGateway  $provider,
        private readonly WorkoutDataModelPersisterGateway $persister,
    ) {

    }

    public function execute(int $id): void
    {
        $workout = $this->provider->getWorkoutById($id);
        if (null === $workout) {
            throw new NotFoundHttpException("Workout #$id cannot be found");
        }

        $this->persister->remove($workout);
    }
}