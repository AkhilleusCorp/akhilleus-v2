<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
use App\Domain\Registry\Workout\MovementStatusRegistry;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use App\Infrastructure\DataFixtures\Equipment\EquipmentFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class MovementFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    protected function explicitFixtures(ObjectManager $manager): void
    {
        $configs = $this->getMovementsConfig();
        foreach ($configs as $config) {
            $movement = new MovementDataModel();
            $movement->name = $config['name'];
            $movement->status = MovementStatusRegistry::MOVEMENT_STATUS_ACTIVE;
            $movement->primaryMuscle = $this->getReference($config['primaryMuscleRef']);

            $auxiliaryMuscles = [];
            foreach ($config['auxiliaryMusclesRefs'] as $auxiliaryMuscleRef) {
                $auxiliaryMuscles[] = $this->getReference($auxiliaryMuscleRef);
            }
            $movement->setAuxiliaryMuscles($auxiliaryMuscles);

            $equipments = [];
            foreach ($config['equipmentsRefs'] as $equipmentRef) {
                $equipments[] = $this->getReference($equipmentRef);
            }
            $movement->setEquipments($equipments);

            $manager->persist($movement);

            $this->addRef('movement', $movement->name, $movement);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        // TODO: Implement volumeFixtures() method.
    }

    /**
     * @return array<mixed>
     */
    private function getMovementsConfig(): array
    {
        return [
            [
                'name' => 'Bench press',
                'primaryMuscleRef' => 'muscle-chest',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-barbell', 'equipment-bench'],
            ],
            [
                'name' => 'Back squat',
                'primaryMuscleRef' => 'muscle-quadriceps',
                'auxiliaryMusclesRefs' => ['muscle-glutes', 'muscle-hamstrings'],
                'equipmentsRefs' => ['equipment-barbell'],
            ],
            [
                'name' => 'Biceps curl',
                'primaryMuscleRef' => 'muscle-biceps',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-dumbbell'],
            ],
            [
                'name' => 'Front squat',
                'primaryMuscleRef' => 'muscle-quadriceps',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-barbell'],
            ],
            [
                'name' => 'Goblet squat',
                'primaryMuscleRef' => 'muscle-quadriceps',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-dumbbell'],
            ],
            [
                'name' => 'Triceps push down (single arm)',
                'primaryMuscleRef' => 'muscle-triceps',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-cable'],
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            MuscleFixtures::class,
            EquipmentFixtures::class,
        ];
    }
}
