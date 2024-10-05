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
                $propertyType = $reflection->getProperty($key)->getType()->getName();
                $filter->{$key} = $this->castType($value, $propertyType);
            }
        }

        return $filter;
    }

    protected function purgeNullStringValues(array $parameters, array $keysToIgnore = []): array
    {
        foreach ($parameters as $key => $value) {
            if (('null' === $value || '' === $value) && false === in_array($key, $keysToIgnore)) {
                unset($parameters[$key]);
            }
        }

        return $parameters;
    }

    private function castType($value, string $propertyType): mixed
    {
        return match ($propertyType) {
            'string' => trim($value),
            'int' => (int) $value,
            'float' => (float) $value,
            'bool' => (bool)$value,
            'array' => explode(',', trim($value)),
            default => $value,
        };
    }
}