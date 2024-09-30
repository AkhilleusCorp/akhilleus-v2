<?php

namespace App\Domain\Factory\DataModelFactory;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

abstract class AbstractDataModelFactory implements DataModelFactoryInterface
{
    public function mergeSourceAndDataModel(DataModelInterface $dataModel, UpdateSourceModelInterface $sourceModel): DataModelInterface
    {
        $reflexion = new \ReflectionClass($sourceModel);
        foreach ($reflexion->getProperties() as $property) {
            $propertyName = $property->getName();
            if (property_exists($dataModel, $propertyName) && isset($sourceModel->{$propertyName})) {
                $dataModel->{$propertyName} = $sourceModel->{$propertyName};
            }
        }

        return $dataModel;
    }
}