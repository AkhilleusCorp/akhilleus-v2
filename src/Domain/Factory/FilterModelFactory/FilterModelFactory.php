<?php

namespace App\Domain\Factory\FilterModelFactory;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Factory\InferModelPropertiesTrait;

class FilterModelFactory
{
    use InferModelPropertiesTrait;

    /**
     * @param array<mixed> $parameters
     */
    public function buildFilterFromParameters(array $parameters, FilterModelInterface $filter): FilterModelInterface
    {
        $reflection = new \ReflectionClass($filter);
        foreach ($parameters as $key => $value) {
            if ('null' === $value || '' === $value) {
                continue;
            }

            if ($reflection->hasProperty($key)) {
                /** @var \ReflectionNamedType $type */
                $type = $reflection->getProperty($key)->getType();
                $propertyType = $type->getName();
                $filter->{$key} = $this->castType($value, $propertyType);
            }
        }

        return $filter;
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
