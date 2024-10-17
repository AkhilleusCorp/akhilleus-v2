<?php

namespace App\Domain\Gateway\Persister;

use App\Domain\DTO\DataModel\DataModelInterface;

interface GenericDataModelPersisterGateway
{
    public function create(DataModelInterface $dto, bool $flush = true): DataModelInterface;

    public function edit(DataModelInterface $dto, bool $flush = true): DataModelInterface;

    public function remove(DataModelInterface $dto, bool $flush = true): void;
}
