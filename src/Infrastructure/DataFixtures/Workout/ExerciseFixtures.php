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
        foreach ($this->getExerciseConfig() as $config) {
            for ($i = 1; $i <= $config['repeat']; $i++) {
                $exercise = new ExerciseDataModel();
                $exercise->movement = $this->getReference($config['movementRef']);
                $exercise->group = $this->getReference($config['groupRef']);

                $manager->persist($exercise);
            }
        }
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

    private function getExerciseConfig(): array
    {
        return [
            ['movementRef' => 'movement-bench-press', 'groupRef' => 'exerciseGroup-in-progress-private-1', 'repeat' => 5],
            ['movementRef' => 'movement-back-squat', 'groupRef' => 'exerciseGroup-in-progress-private-2', 'repeat' => 3],
            ['movementRef' => 'movement-biceps-curl', 'groupRef' => 'exerciseGroup-in-progress-private-3', 'repeat' => 5],
            ['movementRef' => 'movement-front-squat', 'groupRef' => 'exerciseGroup-in-progress-private-4', 'repeat' => 6],
            ['movementRef' => 'movement-goblet-squat', 'groupRef' => 'exerciseGroup-in-progress-private-5', 'repeat' => 3],
        ];
    }
}