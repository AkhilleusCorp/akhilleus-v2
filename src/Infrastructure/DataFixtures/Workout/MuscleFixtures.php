<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\DTO\SourceModel\Workout\CreateMuscleSourceModel;
use App\Domain\Factory\DataModelFactory\Workout\MuscleDataModelFactory;
use App\Domain\Factory\SourceModelFactory\GenericSourceModelFactory;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Persistence\ObjectManager;

final class MuscleFixtures extends AbstractFixtures
{
    public function __construct(
        private readonly GenericSourceModelFactory $sourceModelFactory,
        private readonly MuscleDataModelFactory $dataModelFactory
    )
    {
    }

    protected function explicitFixtures(ObjectManager $manager): void
    {
        $names = ['biceps', 'triceps', 'quads', 'calves', 'chest', 'glutes', 'hamstring'];
        foreach ($names as $name) {
            $source = $this->sourceModelFactory->buildSourceModel(
                ['name' => $name],
                new CreateMuscleSourceModel()
            );

            $muscle = $this->dataModelFactory->buildNewDataModel($source);
            $manager->persist($muscle);

            $this->addReference("muscle-{$muscle->name}", $muscle);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {

    }
}