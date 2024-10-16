<?php

namespace App\Infrastructure\Persister\Workout;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Infrastructure\Persister\AbstractEntityPersister;

final class WorkoutDataModelPersister extends AbstractEntityPersister implements WorkoutDataModelPersisterGateway
{
    public function create(WorkoutDataModel $dto, bool $flush = true): WorkoutDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function edit(WorkoutDataModel $dto, bool $flush = true): WorkoutDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function remove(WorkoutDataModel $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);

        // TODO: Do post delete stuff.
    }
}
