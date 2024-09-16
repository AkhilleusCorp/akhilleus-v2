<?php

namespace App\Domain\Gateway\Provider\User;

use App\Domain\DTO\FilterModel\User\UsersFilterModel;
use App\Domain\DTO\DataModel\User\UserDataModel;

interface UserDTOProviderGateway
{
    public function getUserById(int $userId): ?UserDataModel;

    /**
     * @return UserDataModel[]
     */
    public function getUsersByParameters(UsersFilterModel $filter): array;

    public function countUsersByParameters(UsersFilterModel $filter): int;
}