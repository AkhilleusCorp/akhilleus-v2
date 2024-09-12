<?php

namespace App\Infrastructure\Persister\User;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\User\UserDTO;
use App\Domain\Gateway\Persister\User\UserDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractDTOPersister;

final class UserDTOPersister extends AbstractDTOPersister implements UserDTOPersisterGateway
{
    public function create(UserDTO|DTOInterface $dto, bool $flush = true): UserDTO
    {
        parent::save($dto, $flush);

        // TODO: Do post create stuff.
    }

    public function edit (UserDTO|DTOInterface $dto, bool $flush = true): UserDTO
    {
        parent::save($dto, $flush);

        // TODO: Do post edit stuff.
    }

    public function remove(UserDTO|DTOInterface $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);

        // TODO: Do post delete stuff.
    }
}