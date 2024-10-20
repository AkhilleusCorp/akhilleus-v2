<?php

namespace App\Domain\DTO\DataModel\Workout;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\Registry\Workout\MovementStatusRegistry;
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

    #[ORM\Column(type: Types::STRING, length: 15, nullable: false)]
    public string $status = MovementStatusRegistry::MOVEMENT_STATUS_DRAFT;

    #[ORM\ManyToOne(targetEntity: MuscleDataModel::class)]
    #[ORM\JoinColumn(name: 'primary_muscle_id', referencedColumnName: 'id', onDelete: 'restrict')]
    public MuscleDataModel $primaryMuscle;

    /** @var Collection<int, MuscleDataModel> */
    #[ORM\ManyToMany(targetEntity: MuscleDataModel::class)]
    #[ORM\JoinTable(name: 'MOVEMENTS_MUSCLES')]
    #[ORM\JoinColumn(name: 'movement_id', referencedColumnName: 'id', onDelete: 'restrict')]
    #[ORM\InverseJoinColumn(name: 'muscle_id', referencedColumnName: 'id')]
    public Collection $auxiliaryMuscles;

    /** @var Collection<int, EquipmentDataModel> */
    #[ORM\ManyToMany(targetEntity: EquipmentDataModel::class)]
    #[ORM\JoinTable(name: 'MOVEMENTS_EQUIPMENTS')]
    #[ORM\JoinColumn(name: 'movement_id', referencedColumnName: 'id', onDelete: 'restrict')]
    #[ORM\InverseJoinColumn(name: 'equipment_id', referencedColumnName: 'id')]
    public Collection $equipments;

    public function __construct()
    {
        $this->auxiliaryMuscles = new ArrayCollection();
        $this->equipments = new ArrayCollection();
    }

    /**
     * @param MuscleDataModel[] $muscles
     */
    public function setAuxiliaryMuscles(array $muscles): void
    {
        $this->auxiliaryMuscles->clear();
        foreach ($muscles as $muscle) {
            $this->auxiliaryMuscles->add($muscle);
        }
    }

    /**
     * @param EquipmentDataModel[] $equipments
     */
    public function setEquipments(array $equipments): void
    {
        $this->equipments->clear();
        foreach ($equipments as $equipment) {
            $this->equipments->add($equipment);
        }
    }
}
