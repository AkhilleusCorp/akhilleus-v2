<?php

namespace App\Infrastructure\DataFixtures\Equipment;

use App\Domain\DTO\SourceModel\Equipment\CreateEquipmentSourceModel;
use App\Domain\Factory\DataModelFactory\Equipment\EquipmentDataModelFactory;
use App\Domain\Factory\SourceModelFactory\GenericSourceModelFactory;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Persistence\ObjectManager;

final class EquipmentFixtures extends AbstractFixtures
{
    public function __construct(
        private readonly GenericSourceModelFactory $sourceModelFactory,
        private readonly EquipmentDataModelFactory $dataModelFactory
    ) {
    }

    protected function explicitFixtures(ObjectManager $manager): void
    {
        $names = [
            'barbell', 'dumbbell', 'bench', 'jump-rope', 'cable',
            'none', 'kettlebell', 'machine', 'plate', 'resistance-band',
            'suspension-band', 'other'
        ];
        foreach ($names as $name) {
            $source = $this->sourceModelFactory->buildSourceModel(
                ['name' => $name],
                new CreateEquipmentSourceModel()
            );

            $equipment = $this->dataModelFactory->buildNewDataModel($source);
            $manager->persist($equipment);

            $this->addRef("equipment", $equipment->name, $equipment);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {

    }
}