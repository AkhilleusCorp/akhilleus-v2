<?php

namespace App\UseCase\Authentication;

use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserInterface;

final class AuthenticationSuccessUseCase implements UseCaseInterface
{
    public function __construct()
    {

    }

    public function execute(?UserInterface $user): void
    {
        if (null === $user) {
            throw new NotFoundHttpException();
        }
        // TODO: save last login ?
    }
}