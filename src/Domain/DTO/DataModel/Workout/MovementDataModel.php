<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'MOVEMENT')]
class MovementDataModel implements DataModelInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(type: Types::STRING, length: 150, unique: true)]
    public string $name;

    #[ORM\ManyToOne(targetEntity: MuscleDataModel::class)]
    #[ORM\JoinColumn(name: 'primary_muscle_id', referencedColumnName: 'id')]
    public MuscleDataModel $primaryMuscle;

    #[ORM\ManyToMany(targetEntity: MuscleDataModel::class)]
    #[ORM\JoinTable(name: 'MOVEMENTS_MUSCLES')]
    #[ORM\JoinColumn(name: 'movement_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'muscle_id', referencedColumnName: 'id')]
    private Collection $auxiliaryMuscles;

    #[ORM\ManyToMany(targetEntity: EquipmentDataModel::class)]
    #[ORM\JoinTable(name: 'MOVEMENTS_EQUIPMENTS')]
    #[ORM\JoinColumn(name: 'movement_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'equipment_id', referencedColumnName: 'id')]
    private Collection $equipments;

    public function __construct()
    {
        $this->auxiliaryMuscles = new ArrayCollection();
        $this->equipments = new ArrayCollection();
    }

    public function getAuxiliaryMuscles(): array
    {
        return $this->auxiliaryMuscles->toArray();
    }

    public function setAuxiliaryMuscles(array $muscles): array
    {
        $this->auxiliaryMuscles = new ArrayCollection();
        foreach ($muscles as $muscle) {
            $this->auxiliaryMuscles->add($muscle);
        }
    }

    public function getEquipments(): array
    {
        return $this->equipments->toArray();
    }

    public function setEquipments(array $equipments): array
    {
        $this->equipments = new ArrayCollection();
        foreach ($equipments as $equipment) {
            $this->equipments->add($equipment);
        }
    }
}