<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\Factory\DataModelFactory\Workout\MovementDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateMovementSourceModelFactory;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Persistence\ObjectManager;

final class MovementFixtures extends AbstractFixtures
{
    public function __construct(
        private readonly CreateMovementSourceModelFactory $sourceModelFactory,
        private readonly MovementDataModelFactory $dataModelFactory
    ) {

    }
    protected function explicitFixtures(ObjectManager $manager): void
    {
        $source = $this->sourceModelFactory->buildSourceModel(
            [
                'name' => 'Bench Press',
                'primaryMuscle' => 5,
                'equipments' => [1, 3]
            ]
        );

        $movement = $this->dataModelFactory->buildNewDataModel($source);
        $manager->persist($movement);
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        // TODO: Implement volumeFixtures() method.
    }

}