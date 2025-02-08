<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
use App\Domain\Registry\Workout\MuscleStatusRegistry;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Persistence\ObjectManager;

final class MuscleFixtures extends AbstractFixtures
{
    protected function explicitFixtures(ObjectManager $manager): void
    {
        $configs = $this->getMuscleConfig();
        foreach ($configs as $config) {
            $muscle = new MuscleDataModel();
            $muscle->status = MuscleStatusRegistry::MUSCLE_STATUS_ACTIVE;

            $this->setProperties($muscle, $config);

            $manager->persist($muscle);

            $this->addRef('muscle', $muscle->name, $muscle);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
    }

    /**
     * @return array<mixed>
     */
    private function getMuscleConfig(): array
    {
        return [
            ['name' => 'biceps'],
            ['name' => 'triceps'],
            ['name' => 'quadriceps'],
            ['name' => 'calves'],
            ['name' => 'chest'],
            ['name' => 'glutes'],
            ['name' => 'hamstrings'],
            ['name' => 'abdominals'],
            ['name' => 'abductors'],
            ['name' => 'adductors'],
            ['name' => 'forearms'],
            ['name' => 'lower-back'],
            ['name' => 'cardio'],
            ['name' => 'full-body'],
            ['name' => 'neck'],
            ['name' => 'shoulders'],
            ['name' => 'lats'],
            ['name' => 'traps'],
            ['name' => 'upper-back'],
            ['name' => 'other'],
        ];
    }
}
