<?php

namespace App\Domain\Gateway\Provider\User;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;

interface UserDataModelProviderGateway
{
    public function getUserById(int $userId): ?UserDataModel;

    /**
     * @return UserDataModel[]
     */
    public function getUsersByFilterModel(GetManyUsersFilterModel $filter): array;

    public function countUsersByFilterModel(?GetManyUsersFilterModel $filter): int;
}
