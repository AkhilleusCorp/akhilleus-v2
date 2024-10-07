<?php

namespace App\Domain\DTO\SourceModel\Equipment;

use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class UpdateEquipmentSourceModel implements UpdateSourceModelInterface
{
    public string $name;
    public string $status;
}