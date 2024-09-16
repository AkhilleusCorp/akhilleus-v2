<?php

namespace App\Domain\Factory\SourceModelFactory\User;

use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;

final class CreateUserSourceModelFactory
{
    public function buildCreateUserSourceModel(array $parameters): CreateUserSourceModel
    {
        $model = new createUserSourceModel();

        foreach ($parameters as $key => $value) {
            $model->{$key} = $value;
        }
        return $model;
    }
}