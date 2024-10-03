<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\DTO\DataModel\Workout\MovementDataModel;
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

            $this->addRef("movement", $movement->name, $movement);

        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        // TODO: Implement volumeFixtures() method.
    }

    private function getMovementsConfig(): array
    {
        return [
            [
                'name' => 'Bench press',
                'primaryMuscleRef' => 'muscle-chest',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-barbell', 'equipment-bench']
            ],
            [
                'name' => 'Back squat',
                'primaryMuscleRef' => 'muscle-quads',
                'auxiliaryMusclesRefs' => ['muscle-glutes', 'muscle-hamstring'],
                'equipmentsRefs' => ['equipment-barbell']
            ],
            [
                'name' => 'Biceps curl',
                'primaryMuscleRef' => 'muscle-biceps',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-dumbbell']
            ],
            [
                'name' => 'Front squat',
                'primaryMuscleRef' => 'muscle-quads',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-barbell']
            ],
            [
                'name' => 'Goblet squat',
                'primaryMuscleRef' => 'muscle-quads',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-dumbbell']
            ],
            [
                'name' => 'Triceps push down (single arm)',
                'primaryMuscleRef' => 'muscle-triceps',
                'auxiliaryMusclesRefs' => [],
                'equipmentsRefs' => ['equipment-cable']
            ]
        ];
    }

    public function getDependencies(): array
    {
        return [
            MuscleFixtures::class,
            EquipmentFixtures::class,
        ];
    }
}