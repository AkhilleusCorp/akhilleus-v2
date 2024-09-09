<?php

namespace App\UseCase\User;

use App\Domain\DTO\User\UserDTO;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneUserUseCase implements UseCaseInterface
{
    public function __construct(private UserDTOProviderGateway $provider)
    {

    }
    public function execute(int $id): UserDTO
    {
        $user = $this->provider->getUserById($id);
        if (null === $user) {
            throw new NotFoundHttpException("User #$id cannot be found");
        }

        return $user;
    }
}