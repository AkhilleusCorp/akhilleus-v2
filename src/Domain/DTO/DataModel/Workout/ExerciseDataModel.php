<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\Registry\Workout\ExerciseTypeRegistry;
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

    #[ORM\Column(type: Types::STRING)]
    public string $type = ExerciseTypeRegistry::EXERCISE_TYPE_NORMAL;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    public ?int $targetReps = null;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    public ?float $targetWeight = null; // in Kg

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    public ?int $targetDuration = null; // in seconds

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    public ?float $targetDistance = null; // in Km

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    public ?float $targetSpeed = null; // in Km/h

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    public ?int $reps = null;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    public ?int $weight = null; // in Kg

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    public ?int $duration = null; // in seconds

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    public ?int $distance = null; // in Km

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    public ?int $speed = null; // in Km/h

    #[ORM\Column(type: Types::BOOLEAN)]
    public bool $isCompleted = false;

    #[ORM\ManyToOne(targetEntity: MovementDataModel::class)]
    #[ORM\JoinColumn(name: 'movement_id', referencedColumnName: 'id', onDelete: 'restrict')]
    public MovementDataModel $movement;

    #[ORM\ManyToOne(targetEntity: ExerciseGroupDataModel::class)]
    #[ORM\JoinColumn(name: 'group_id', referencedColumnName: 'id')]
    public ExerciseGroupDataModel $group;
}
