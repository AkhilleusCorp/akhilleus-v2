<?php

namespace App\UseCase\User;

use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneUserByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDataModelProviderGateway  $provider,
        private readonly UserDataModelPersisterGateway $persister,
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