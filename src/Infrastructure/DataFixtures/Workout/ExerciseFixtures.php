<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseDataModel;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ExerciseFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    protected function explicitFixtures(ObjectManager $manager): void
    {
        $exercise = new ExerciseDataModel();
        $exercise->movement = $this->getReference("movement-Bench Press");
        $exercise->group = $this->getReference("exerciseGroup-InProgressPrivate-1");

        $manager->persist($exercise);

        $this->addReference("exercise-GroupInProgressPrivate-1", $exercise);
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        // TODO: Implement volumeFixtures() method.
    }

    public function getDependencies(): array
    {
        return [
            WorkoutFixtures::class,
            ExerciseGroupFixtures::class
        ];
    }
}