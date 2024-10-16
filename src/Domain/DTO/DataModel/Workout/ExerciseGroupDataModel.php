<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'EXERCISE_GROUP')]
class ExerciseGroupDataModel implements DataModelInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\ManyToOne(targetEntity: WorkoutDataModel::class)]
    #[ORM\JoinColumn(name: 'workout_id', referencedColumnName: 'id', onDelete: 'restrict')]
    public WorkoutDataModel $workout;

    /** @var int[] */
    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    public array $movementIds;

    /** @var Collection<int, ExerciseDataModel> */
    #[ORM\OneToMany(targetEntity: ExerciseDataModel::class, mappedBy: 'group', cascade: ['persist', 'remove'])]
    public Collection $exercises;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
    }
}
