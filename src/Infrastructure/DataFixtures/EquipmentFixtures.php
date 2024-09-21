<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Factory\DataModelFactory\Equipment\EquipmentDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Equipment\CreateEquipmentSourceModelFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class EquipmentFixtures extends Fixture
{
    public function __construct(
        private CreateEquipmentSourceModelFactory $sourceModelFactory,
        private EquipmentDataModelFactory $dataModelFactory
    ) {

    }
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 50; $i++) {
            $name = "equipment{$i}";
            $source = $this->sourceModelFactory->buildSourceModel(
                ['name' => $name]
            );

            $equipment = $this->dataModelFactory->buildNewDataModel($source);
            $manager->persist($equipment);

            $this->addReference("equipment-{$name}", $equipment);
        }

        $manager->flush();
    }
}