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
        $configs = $this->getEquipmentConfig();
        foreach ($configs as $config) {
            $equipment = new EquipmentDataModel();
            $equipment->status = EquipmentStatusRegistry::EQUIPMENT_STATUS_ACTIVE;

            $this->setProperties($equipment, $config);

            $manager->persist($equipment);

            $this->addRef('equipment', $equipment->name, $equipment);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
    }

    /**
     * @return array<mixed>
     */
    private function getEquipmentConfig(): array
    {
        return [
            ['name' => 'barbell'],
            ['name' => 'dumbbell'],
            ['name' => 'bench'],
            ['name' => 'jump-rope'],
            ['name' => 'cable'],
            ['name' => 'none'],
            ['name' => 'kettlebell'],
            ['name' => 'machine'],
            ['name' => 'plate'],
            ['name' => 'resistance-band'],
            ['name' => 'suspension-band'],
            ['name' => 'other'],
        ];
    }
}
