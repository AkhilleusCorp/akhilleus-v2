<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
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
    public ?\DateTimeImmutable $startDate = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $endDate = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $plannedDate = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    public ?int $duration = null; // Stored in seconds

    /** @var Collection<int, ExerciseGroupDataModel> */
    #[ORM\OneToMany(targetEntity: ExerciseGroupDataModel::class, mappedBy: 'workout', cascade: ['remove'])]
    public Collection $exerciseGroups;

    #[ORM\ManyToOne(targetEntity: UserDataModel::class)]
    #[ORM\JoinColumn(name: 'member_id', referencedColumnName: 'id')]
    public UserDataModel $member;

    #[ORM\ManyToOne(targetEntity: UserDataModel::class)]
    #[ORM\JoinColumn(name: 'coach_id', referencedColumnName: 'id', nullable: true)]
    public ?UserDataModel $coach;

    public function __construct()
    {
        $this->exerciseGroups = new ArrayCollection();
    }
}
