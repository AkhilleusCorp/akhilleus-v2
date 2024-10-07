<?php

namespace App\Domain\DTO\DataModel\Equipment;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\Registry\Equipment\EquipmentStatusRegistry;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'EQUIPMENT')]
class EquipmentDataModel implements DataModelInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(type: Types::STRING, length: 150, unique: true)]
    public string $name;

    #[ORM\Column(type: Types::STRING, length: 15, nullable: false)]
    public string $status = EquipmentStatusRegistry::EQUIPMENT_STATUS_DRAFT;
}