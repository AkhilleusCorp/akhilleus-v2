<?php

namespace App\Domain\Factory\SourceModelFactory\User;

use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class CreateUserSourceModelFactory implements SourceModelFactoryInterface
{
    public function buildSourceModel(array $parameters): CreateUserSourceModel
    {
        $model = new CreateUserSourceModel();
        $model->username = $parameters['username'];
        $model->email = $parameters['email'];
        $model->plainPassword = $parameters['plainPassword'];

        return $model;
    }
}