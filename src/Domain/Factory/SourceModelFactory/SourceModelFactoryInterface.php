<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\SourceModelInterface;

interface SourceModelFactoryInterface
{
    public function buildSourceModel(array $parameters): SourceModelInterface;
}