<?php

namespace App\UseCase\Website\Authentication;

use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserInterface;

final class AuthenticationSuccessUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDataModelPersisterGateway $persister,
    ) {

    }

    public function execute(?UserInterface $user): void
    {
        if (null === $user) {
            throw new NotFoundHttpException();
        }

        $user->lifecycle->lastLoginDate = new \DateTimeImmutable();

        $this->persister->edit($user);
    }
}