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
        $names = [
            'biceps', 'triceps', 'quadriceps', 'calves', 'chest', 'glutes', 'hamstrings',
            'abdominals', 'abductors', 'adductors', 'forearms', 'lower-back', 'cardio', 'full-body',
            'neck', 'shoulders', 'lats', 'traps', 'upper-back', 'other',
        ];
        foreach ($names as $name) {
            $muscle = new MuscleDataModel();
            $muscle->name = $name;
            $muscle->status = MuscleStatusRegistry::MUSCLE_STATUS_ACTIVE;

            $manager->persist($muscle);

            $this->addRef('muscle', $muscle->name, $muscle);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
    }
}
