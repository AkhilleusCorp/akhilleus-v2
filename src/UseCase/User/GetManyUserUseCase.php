<?php

namespace App\UseCase\User;

use App\Domain\DTO\User\UserDTO;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\UseCase\UseCaseInterface;

final class GetManyUserUseCase implements UseCaseInterface
{
    public function __construct(private readonly UserDTOProviderGateway $provider)
    {

    }

    /**
     * @return UserDTO[]
     */
    public function execute(array $parameters): array
    {
        return $this->provider->getUsersByParameters($parameters);
    }
}