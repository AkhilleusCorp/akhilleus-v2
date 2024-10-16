<?php

namespace App\Domain\Gateway\Persister\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;

interface ExerciseGroupDataModelPersisterGateway
{
    public function create(ExerciseGroupDataModel $dto, bool $flush = true): ExerciseGroupDataModel;

    public function edit(ExerciseGroupDataModel $dto, bool $flush = true): ?ExerciseGroupDataModel;

    public function remove(ExerciseGroupDataModel $dto, bool $flush = true): void;
}
