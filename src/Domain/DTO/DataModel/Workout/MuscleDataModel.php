<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\Registry\Workout\MuscleStatusRegistry;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'MUSCLE')]
class MuscleDataModel implements DataModelInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(type: Types::STRING, length: 150, unique: true)]
    public string $name;

    #[ORM\Column(type: Types::STRING, length: 15, nullable: false)]
    public string $status = MuscleStatusRegistry::MUSCLE_STATUS_DRAFT;
}
