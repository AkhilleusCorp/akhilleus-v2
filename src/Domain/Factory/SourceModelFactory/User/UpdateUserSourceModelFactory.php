<?php

namespace App\Domain\Factory\SourceModelFactory\User;

use App\Domain\DTO\SourceModel\User\UpdateUserSourceModel;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class UpdateUserSourceModelFactory implements SourceModelFactoryInterface
{
    public function buildSourceModel(array $parameters): UpdateUserSourceModel
    {
        $model = new UpdateUserSourceModel();
        $model->login = $parameters['login'];
        $model->email = $parameters['email'];

        return $model;
    }
}