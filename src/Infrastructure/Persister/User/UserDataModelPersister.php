<?php

namespace App\Infrastructure\Persister\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Infrastructure\Persister\AbstractEntityPersister;

final class UserDataModelPersister extends AbstractEntityPersister implements UserDataModelPersisterGateway
{
    public function create(UserDataModel|DataModelInterface $dto, bool $flush = true): UserDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function edit (UserDataModel|DataModelInterface $dto, bool $flush = true): UserDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function remove(UserDataModel|DataModelInterface $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);

        // TODO: Do post delete stuff.
    }
}