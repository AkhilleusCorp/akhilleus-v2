<?php

namespace App\UseCase\API\User;

use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneUserByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDataModelProviderGateway $provider,
        private readonly SingleUserViewPresenter $presenter,
    ) {
    }

    public function execute(int $id, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $user = $this->provider->getUserById($id);
        if (null === $user) {
            throw new NotFoundHttpException("User #$id cannot be found");
        }

        return $this->presenter->present($user, $payload->userType);
    }
}
