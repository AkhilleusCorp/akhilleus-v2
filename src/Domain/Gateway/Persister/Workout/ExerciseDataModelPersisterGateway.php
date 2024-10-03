<?php

namespace App\Domain\Gateway\Persister\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseDataModel;

interface ExerciseDataModelPersisterGateway
{
    public function create(ExerciseDataModel $dto, bool $flush = true): ExerciseDataModel;

    public function edit(ExerciseDataModel $dto, bool $flush = true): ?ExerciseDataModel;

    public function remove(ExerciseDataModel $dto, bool $flush = true): void;
}