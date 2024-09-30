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
        $movement = new MovementDataModel();
        $movement->name = 'Bench Press';
        $movement->primaryMuscle = $this->getReference('muscle-chest');
        $movement->setEquipments([
            $this->getReference('equipment-barbell'),
            $this->getReference('equipment-bench'),
        ]);

        $manager->persist($movement);
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        // TODO: Implement volumeFixtures() method.
    }

    public function getDependencies(): array
    {
        return [
            MuscleFixtures::class,
            EquipmentFixtures::class,
        ];
    }
}