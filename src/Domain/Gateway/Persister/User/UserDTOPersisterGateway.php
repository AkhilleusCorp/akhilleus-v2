<?php

namespace App\Domain\Gateway\Persister\User;

use App\Domain\DTO\User\UserDTO;

interface UserDTOPersisterGateway
{
    public function create(UserDTO $dto, bool $flush = true): UserDTO;

    public function edit(UserDTO $dto, bool $flush = true): UserDTO;

    public function remove(UserDTO $dto, bool $flush = true): void;
}