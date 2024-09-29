<?php

namespace App\Infrastructure\Persister\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Infrastructure\Persister\AbstractEntityPersister;

final class WorkoutDataModelPersister extends AbstractEntityPersister implements WorkoutDataModelPersisterGateway
{
    public function create(WorkoutDataModel|DataModelInterface $dto, bool $flush = true): WorkoutDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function edit (WorkoutDataModel|DataModelInterface $dto, bool $flush = true): WorkoutDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function remove(WorkoutDataModel|DataModelInterface $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);

        // TODO: Do post delete stuff.
    }
}