<?php

namespace App\Domain\Factory\SourceModelFactory\User;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\User\UpdateUserSourceModel;
use App\Domain\Factory\SourceModelFactory\InferSourceModelFactoryTrait;
use App\Domain\Factory\SourceModelFactory\SourceModelFactoryInterface;

final class UpdateUserSourceModelFactory implements SourceModelFactoryInterface
{
    use InferSourceModelFactoryTrait;

    public function buildSourceModel(array $parameters): UpdateUserSourceModel|SourceModelInterface
    {
        return $this->inferSourceModel($parameters, new UpdateUserSourceModel());
    }
}