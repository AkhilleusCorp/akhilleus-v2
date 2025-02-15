<?php

namespace App\UseCase\API\Workout;

use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneMovementByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly MovementDataModelProviderGateway $provider,
        private readonly SingleMovementViewPresenter $presenter,
    ) {
    }

    public function execute(int $id, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $movement = $this->provider->getMovementById($id);
        if (null === $movement) {
            throw new NotFoundHttpException("Movement #$id cannot be found");
        }

        return $this->presenter->present($movement, $payload->userType);
    }
}
