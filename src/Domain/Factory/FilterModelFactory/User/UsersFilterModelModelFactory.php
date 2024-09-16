<?php

namespace App\Domain\Factory\FilterModelFactory\User;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\User\UsersFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;

final class UsersFilterModelModelFactory extends AbstractFilterModelFactory
{
    public function buildUserFilterModel(array $parameters): UsersFilterModel
    {
        return $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            new UsersFilterModel()
        );
    }
}