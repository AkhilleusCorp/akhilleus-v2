<?php

namespace App\Domain\Gateway\Provider\User;

use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\DTO\DataModel\User\UserDataModel;

interface UserDTOProviderGateway
{
    public function getUserById(int $userId): ?UserDataModel;

    /**
     * @return UserDataModel[]
     */
    public function getUsersByParameters(GetManyUsersFilterModel $filter): array;

    public function countUsersByParameters(GetManyUsersFilterModel $filter): int;
}