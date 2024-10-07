<?php

namespace App\Infrastructure\DataFixtures\Equipment;

use App\Domain\DTO\DataModel\Equipment\EquipmentDataModel;
use App\Domain\Registry\Equipment\EquipmentStatusRegistry;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Persistence\ObjectManager;

final class EquipmentFixtures extends AbstractFixtures
{
    protected function explicitFixtures(ObjectManager $manager): void
    {
        $names = [
            'barbell', 'dumbbell', 'bench', 'jump-rope', 'cable',
            'none', 'kettlebell', 'machine', 'plate', 'resistance-band',
            'suspension-band', 'other'
        ];
        foreach ($names as $name) {
            $equipment = new EquipmentDataModel();
            $equipment->name = $name;
            $equipment->status = EquipmentStatusRegistry::EQUIPMENT_STATUS_ACTIVE;

            $manager->persist($equipment);

            $this->addRef("equipment", $equipment->name, $equipment);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {

    }
}