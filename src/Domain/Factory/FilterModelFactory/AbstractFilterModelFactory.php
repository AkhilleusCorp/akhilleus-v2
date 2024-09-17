<?php

namespace App\Domain\Factory\FilterModelFactory;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use ReflectionClass;

abstract class AbstractFilterModelFactory
{
    protected function buildFilter(array $parameters, FilterModelInterface $filter): FilterModelInterface
    {
        $reflection = new ReflectionClass($filter);
        foreach ($parameters as $key => $value) {
            if ($reflection->hasProperty($key)) {
                $propertyType = $reflection->getProperty($key)->getType()?->getName();
                if (null !== $propertyType) {
                    $filter->{$key} = $this->castType($value, $propertyType);
                } else {
                    $filter->{$key} = $value;
                }
            }
        }

        return $filter;
    }

    protected function purgeNullStringValues(array $parameters, array $keysToIgnore = []): array
    {
        foreach ($parameters as $key => $value) {
            if ('null' === $value && false === in_array($key, $keysToIgnore)) {
                unset($parameters[$key]);
            }
        }

        return $parameters;
    }

    private function castType($value, string $propertyType): mixed
    {
        return match ($propertyType) {
            'int' => intval($value),
            'float' => floatval($value),
            'bool' => (bool)$value,
            'array' => explode(',', $value),
            default => $value,
        };
    }
}