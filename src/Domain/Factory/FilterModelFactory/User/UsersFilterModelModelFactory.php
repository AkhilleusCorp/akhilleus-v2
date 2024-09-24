<?php

namespace App\Domain\Factory\FilterModelFactory\User;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;

final class UsersFilterModelModelFactory extends AbstractFilterModelFactory
{
    public function buildGetManyUsersFilterModel(array $parameters): GetManyUsersFilterModel|FilterModelInterface
    {
        return $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            new GetManyUsersFilterModel()
        );
    }
}