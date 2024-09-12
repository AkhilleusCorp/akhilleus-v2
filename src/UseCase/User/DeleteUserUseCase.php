<?php

namespace App\UseCase\User;

use App\Domain\Gateway\Persister\User\UserDTOPersisterGateway;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDTOProviderGateway $provider,
        private readonly UserDTOPersisterGateway $persister,
    ) {

    }

    public function execute(int $id): void
    {
        $user = $this->provider->getUserById($id);
        if (null === $user) {
            throw new NotFoundHttpException("User #$id cannot be found");
        }

        $this->persister->remove($user);
    }
}