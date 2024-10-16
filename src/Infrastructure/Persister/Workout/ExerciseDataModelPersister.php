<?php

namespace App\Infrastructure\Persister\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseDataModel;
use App\Domain\Gateway\Persister\Workout\ExerciseDataModelPersisterGateway;
use App\Infrastructure\Persister\AbstractEntityPersister;
use Doctrine\ORM\EntityManagerInterface;

final class ExerciseDataModelPersister extends AbstractEntityPersister implements ExerciseDataModelPersisterGateway
{
    public function __construct(
        EntityManagerInterface $entityManager,
        private readonly ExerciseGroupDataModelPersister $groupPersister,
    ) {
        parent::__construct($entityManager);
    }

    public function create(ExerciseDataModel $dto, bool $flush = true): ExerciseDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function edit(ExerciseDataModel $dto, bool $flush = true): ?ExerciseDataModel
    {
        parent::save($dto, $flush);

        return $dto;
    }

    public function remove(ExerciseDataModel $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);

        if (true === $dto->group->exercises->isEmpty()) {
            $this->groupPersister->remove($dto->group, $flush);
        }
    }
}
