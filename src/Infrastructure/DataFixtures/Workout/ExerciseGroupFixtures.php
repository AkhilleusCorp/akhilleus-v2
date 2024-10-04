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
        for($i = 1; $i <= 5; $i++) {
            $group = new ExerciseGroupDataModel();
            $group->movementIds = [$i]; // Those values are theoretical as Ids are not know in fixture context
            $group->workout = $this->getReference("workout-in-progress-private");

            $manager->persist($group);

            $this->addReference("exerciseGroup-in-progress-private-{$i}", $group);
        }
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