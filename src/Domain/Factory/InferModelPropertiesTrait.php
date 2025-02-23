<?php

namespace App\Domain\Factory;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;

trait InferModelPropertiesTrait
{
    /**
     * @param array<mixed> $parameters
     */
    protected function inferFromParameters(array $parameters, SourceModelInterface|FilterModelInterface $model): void
    {
        $reflection = new \ReflectionClass($model);
        foreach ($parameters as $key => $value) {
            if ($reflection->hasProperty($key)) {
                /** @var \ReflectionNamedType $type */
                $type = $reflection->getProperty($key)->getType();
                $propertyType = $type->getName();

                if ($type->allowsNull() && ('null' === $value || '' === $value)) {
                    $model->{$key} = null;
                } else {
                    $model->{$key} = $this->castType($value, $propertyType);
                }
            }
        }
    }

    private function castType(mixed $value, string $propertyType): mixed
    {
        return match ($propertyType) {
            'string' => trim($value),
            'int' => (int) $value,
            'float' => (float) $value,
            'bool' => (bool) $value,
            'array' => $this->castArrayType($value),
            default => $value,
        };
    }

    private function castArrayType(array $values): array
    {
        $convertedValues = [];
        foreach ($values as $value) {
            if (is_numeric($value)) {
                $convertedValues[] = (int) $value;
            }
        }

        return $convertedValues;
    }
}
