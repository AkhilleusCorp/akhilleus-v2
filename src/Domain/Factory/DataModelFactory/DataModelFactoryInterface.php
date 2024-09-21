<?php

namespace App\Domain\Factory\DataModelFactory;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;

interface DataModelFactoryInterface
{
    public function buildNewDataModel(SourceModelInterface $source): DataModelInterface;
}