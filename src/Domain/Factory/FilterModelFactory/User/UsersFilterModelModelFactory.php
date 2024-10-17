<?php

namespace App\Domain\Factory\FilterModelFactory\User;

use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;

final class UsersFilterModelModelFactory extends AbstractFilterModelFactory
{
    /**
     * @param array<mixed> $parameters
     */
    public function buildGetManyUsersFilterModel(array $parameters): GetManyUsersFilterModel
    {
        $filterModel = new GetManyUsersFilterModel();
        $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            $filterModel
        );

        return $filterModel;
    }
}
