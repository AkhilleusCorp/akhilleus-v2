<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ExerciseGroupFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    protected function explicitFixtures(ObjectManager $manager): void
    {
        $group = new ExerciseGroupDataModel();
        $group->workout = $this->getReference("workout-InProgressPrivate");

        $manager->persist($group);

        $this->addReference("exerciseGroup-InProgressPrivate-1", $group);
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        // TODO: Implement volumeFixtures() method.
    }

    public function getDependencies(): array
    {
        return [
            WorkoutFixtures::class
        ];
    }
}