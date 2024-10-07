<?php

namespace App\Domain\DTO\SourceModel\Equipment;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;

final class CreateEquipmentSourceModel implements CreateSourceModelInterface
{
    public string $name;
    public string $status;
}