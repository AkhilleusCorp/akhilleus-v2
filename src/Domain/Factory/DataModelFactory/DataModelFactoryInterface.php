<?php

namespace App\Domain\Factory\DataModelFactory;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

interface DataModelFactoryInterface
{
    public function buildNewDataModel(CreateSourceModelInterface $source): DataModelInterface;

    public function mergeSourceAndDataModel(DataModelInterface $dataModel, UpdateSourceModelInterface $sourceModel): DataModelInterface;
}