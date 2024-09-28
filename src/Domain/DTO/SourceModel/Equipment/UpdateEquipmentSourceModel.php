<?php

namespace App\Domain\DTO\SourceModel\Equipment;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class UpdateEquipmentSourceModel implements SourceModelInterface, UpdateSourceModelInterface
{
    public string $name;
}