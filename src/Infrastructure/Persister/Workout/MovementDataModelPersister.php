<?php

namespace App\Infrastructure\Persister\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\Gateway\Persister\Workout\MovementDataModelPersisterGateway;
use App\Infrastructure\Persister\AbstractEntityPersister;

final class MovementDataModelPersister extends AbstractEntityPersister implements MovementDataModelPersisterGateway
{
    public function create(MovementDataModel $dto, bool $flush = true): MovementDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function edit(MovementDataModel $dto, bool $flush = true): MovementDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function remove(MovementDataModel $dto, bool $flush = true): void
    {
        // Todo: once it's used for Exercises, soft deleted if used, hard delete if not

        parent::delete($dto, $flush);
    }
}
