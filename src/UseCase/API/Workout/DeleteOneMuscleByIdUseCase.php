<?php

namespace App\UseCase\API\Workout;

use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneMuscleByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly MuscleDataModelProviderGateway $provider,
    ) {
    }

    public function execute(int $id): void
    {
        $muscle = $this->provider->getOneById($id);
        if (null === $muscle) {
            throw new NotFoundHttpException("Muscle #$id cannot be found");
        }
    }
}
