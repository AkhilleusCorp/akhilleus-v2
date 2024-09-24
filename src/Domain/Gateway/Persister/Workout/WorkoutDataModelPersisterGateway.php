<?php

namespace App\Domain\Gateway\Persister\Workout;

use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;

interface WorkoutDataModelPersisterGateway
{
    public function create(WorkoutDataModel $dto, bool $flush = true): WorkoutDataModel;

    public function edit(WorkoutDataModel $dto, bool $flush = true): WorkoutDataModel;

    public function remove(WorkoutDataModel $dto, bool $flush = true): void;
}