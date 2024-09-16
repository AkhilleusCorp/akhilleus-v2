<?php

namespace App\Infrastructure\Persister\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Gateway\Persister\User\UserDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractDTOPersister;

final class UserDTOPersister extends AbstractDTOPersister implements UserDTOPersisterGateway
{
    public function create(UserDataModel|DataModelInterface $dto, bool $flush = true): UserDataModel
    {
        parent::save($dto, $flush);

        // TODO: Do post create stuff.
    }

    public function edit (UserDataModel|DataModelInterface $dto, bool $flush = true): UserDataModel
    {
        parent::save($dto, $flush);

        // TODO: Do post edit stuff.
    }

    public function remove(UserDataModel|DataModelInterface $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);

        // TODO: Do post delete stuff.
    }
}