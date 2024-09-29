<?php

namespace App\Infrastructure\Persister;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\Gateway\Persister\GenericDataModelPersisterGateway;

final class GenericPersister extends AbstractEntityPersister implements GenericDataModelPersisterGateway
{

    public function create(DataModelInterface $dto, bool $flush = true): DataModelInterface
    {
        return parent::save($dto, $flush);
    }

    public function edit (DataModelInterface $dto, bool $flush = true): DataModelInterface
    {
        return parent::save($dto, $flush);
    }

    public function remove(DataModelInterface $dto, bool $flush = true): void
    {
        parent::delete($dto, $flush);
    }
}