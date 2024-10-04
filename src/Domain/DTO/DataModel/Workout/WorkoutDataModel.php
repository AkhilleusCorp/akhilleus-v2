<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Domain\Registry\Workout\WorkoutVisibilityRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'WORKOUT')]
class WorkoutDataModel implements DataModelInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(type: Types::STRING, length: 150, unique: true)]
    public string $name;

    #[ORM\Column(type: Types::STRING, length: 15)]
    public string $status = WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS;

    #[ORM\Column(type: Types::STRING, length: 20)]
    public string $visibility = WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_FRIENDS;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $startDate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $endDate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $plannedDate;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    public ?int $duration; // Stored in seconds

    #[ORM\OneToMany(targetEntity: ExerciseGroupDataModel::class, mappedBy: 'workout', cascade: ['remove'])]
    public Collection $exerciseGroups;

    public function __construct()
    {
        $this->exerciseGroups = new ArrayCollection();
    }
}