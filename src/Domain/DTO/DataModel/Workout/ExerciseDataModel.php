<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'EXERCISE')]
class ExerciseDataModel implements DataModelInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\ManyToOne(targetEntity: MovementDataModel::class)]
    #[ORM\JoinColumn(name: 'movement_id', referencedColumnName: 'id', onDelete: 'restrict')]
    public MovementDataModel $movement;

    #[ORM\ManyToOne(targetEntity: ExerciseGroupDataModel::class)]
    #[ORM\JoinColumn(name: 'group_id', referencedColumnName: 'id')]
    public ExerciseGroupDataModel $group;
}