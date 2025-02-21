<?php

namespace App\Domain\DTO\SourceModel\Equipment;

use App\Domain\Registry\Equipment\EquipmentStatusRegistry;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractEquipmentSourceModel
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\Choice(choices: EquipmentStatusRegistry::EQUIPMENT_STATUSES)]
    public string $status;
}
