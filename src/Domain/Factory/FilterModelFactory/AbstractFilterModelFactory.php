<?php

namespace App\Domain\Factory\FilterModelFactory;

use App\Domain\DTO\FilterModel\FilterModelInterface;

abstract class AbstractFilterModelFactory
{
    /**
     * @param array<mixed> $parameters
     */
    protected function buildFilter(array $parameters, FilterModelInterface $filter): FilterModelInterface
    {
        $reflection = new \ReflectionClass($filter);
        foreach ($parameters as $key => $value) {
            if ($reflection->hasProperty($key)) {
                /** @var \ReflectionNamedType $type */
                $type = $reflection->getProperty($key)->getType();
                $propertyType = $type->getName();
                $filter->{$key} = $this->castType($value, $propertyType);
            }
        }

        return $filter;
    }

    /**
     * @param array<mixed> $parameters
     * @param string[]     $keysToIgnore
     *
     * @return array<mixed>
     */
    protected function purgeNullStringValues(array $parameters, array $keysToIgnore = []): array
    {
        foreach ($parameters as $key => $value) {
            if (('null' === $value || '' === $value) && false === in_array($key, $keysToIgnore)) {
                unset($parameters[$key]);
            }
        }

        return $parameters;
    }

    private function castType(mixed $value, string $propertyType): mixed
    {
        return match ($propertyType) {
            'string' => trim($value),
            'int' => (int) $value,
            'float' => (float) $value,
            'bool' => (bool) $value,
            'array' => explode(',', trim($value)),
            default => $value,
        };
    }
}
