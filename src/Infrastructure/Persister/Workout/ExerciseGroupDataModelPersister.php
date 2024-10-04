<?php

namespace App\Infrastructure\Persister\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Domain\Gateway\Persister\Workout\ExerciseGroupDataModelPersisterGateway;
use App\Infrastructure\Persister\AbstractEntityPersister;

final class ExerciseGroupDataModelPersister extends AbstractEntityPersister implements ExerciseGroupDataModelPersisterGateway
{
    public function create(ExerciseGroupDataModel $dto, bool $flush = true): ExerciseGroupDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function edit (ExerciseGroupDataModel $dto, bool $flush = true): ?ExerciseGroupDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function remove(ExerciseGroupDataModel $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);
    }
}