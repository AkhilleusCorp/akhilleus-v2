<?php

namespace App\Domain\Factory\DataModelFactory;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

interface DataModelFactoryInterface
{
    public function buildNewDataModel(SourceModelInterface $source): DataModelInterface;

    public function mergeSourceAndDataModel(DataModelInterface $dataModel, UpdateSourceModelInterface $model): DataModelInterface;
}