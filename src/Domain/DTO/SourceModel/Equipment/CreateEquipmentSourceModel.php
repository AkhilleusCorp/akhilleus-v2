<?php

namespace App\Domain\DTO\SourceModel\Equipment;

use App\Domain\DTO\SourceModel\SourceModelInterface;

final class CreateEquipmentSourceModel implements SourceModelInterface
{
    public string $name;
}