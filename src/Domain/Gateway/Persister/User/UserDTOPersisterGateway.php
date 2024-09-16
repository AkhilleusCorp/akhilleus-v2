<?php

namespace App\Domain\Gateway\Persister\User;

use App\Domain\DTO\DataModel\User\UserDataModel;

interface UserDTOPersisterGateway
{
    public function create(UserDataModel $dto, bool $flush = true): UserDataModel;

    public function edit(UserDataModel $dto, bool $flush = true): UserDataModel;

    public function remove(UserDataModel $dto, bool $flush = true): void;
}