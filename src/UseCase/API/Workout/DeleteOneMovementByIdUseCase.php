<?php

namespace App\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\MovementDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneMovementByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly MovementDataModelProviderGateway $provider,
        private readonly MovementDataModelPersisterGateway $persister,
    ) {
    }

    public function execute(int $id): void
    {
        $movement = $this->provider->getMovementById($id);
        if (null === $movement) {
            throw new NotFoundHttpException("Movement #$id cannot be found");
        }

        $this->persister->remove($movement);
    }
}
