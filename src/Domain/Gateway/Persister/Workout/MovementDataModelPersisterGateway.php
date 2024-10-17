<?php

namespace App\Domain\Gateway\Persister\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;

interface MovementDataModelPersisterGateway
{
    public function create(MovementDataModel $dto, bool $flush = true): MovementDataModel;

    public function edit(MovementDataModel $dto, bool $flush = true): MovementDataModel;

    public function remove(MovementDataModel $dto, bool $flush = true): void;
}
