<?php

namespace App\Infrastructure\DataFixtures\Workout;

use App\Domain\DataTransformer\WorkoutDurationDataTransformer;
use App\Domain\DataTransformer\WorkoutStatusDataTransformer;
use App\Domain\DTO\DataModel\Workout\WorkoutDataModel;
use App\Domain\Registry\Workout\WorkoutVisibilityRegistry;
use App\Infrastructure\DataFixtures\AbstractFixtures;
use Doctrine\Persistence\ObjectManager;

final class WorkoutFixtures extends AbstractFixtures
{
    protected function explicitFixtures(ObjectManager $manager): void
    {
        foreach ($this->getWorkoutConfig() as $config) {
            $workout = new WorkoutDataModel();
            $workout->name = $config['name'];
            $workout->visibility = $config['visibility'];
            $workout->startDate = $config['startDate'];
            $workout->endDate = $config['endDate'];
            $workout->plannedDate = $config['plannedDate'];
            $workout->duration = WorkoutDurationDataTransformer::computeDurationInSeconds($workout);
            $workout->status = WorkoutStatusDataTransformer::computeStatus($workout);
            $workout->member = $this->getReference('user-ghriim');
            $workout->coach = null;

            $manager->persist($workout);

            $this->addRef('workout', $workout->name, $workout);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        for ($i = 1; $i < 50; ++$i) {
            $workout = new WorkoutDataModel();
            $workout->name = "workout{$i}";
            $workout->visibility = WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PUBLIC;
            $workout->startDate = new \DateTimeImmutable('1day 2hours ago');
            $workout->endDate = new \DateTimeImmutable('1 day 1hours ago');
            $workout->plannedDate = null;
            $workout->duration = WorkoutDurationDataTransformer::computeDurationInSeconds($workout);
            $workout->status = WorkoutStatusDataTransformer::computeStatus($workout);

            $manager->persist($workout);

            $this->addRef('workout', $workout->name, $workout);
        }
    }

    /**
     * @return array<mixed>
     */
    private function getWorkoutConfig(): array
    {
        return [
            [
                'name' => 'In Progress Private',
                'startDate' => new \DateTimeImmutable('5min ago'),
                'endDate' => null,
                'plannedDate' => null,
                'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PRIVATE,
            ], [
                'name' => 'Plan Specific Client',
                'startDate' => null,
                'endDate' => null,
                'plannedDate' => new \DateTimeImmutable('2days'),
                'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_SPECIFIC_CLIENT,
            ], [
                'name' => 'Completed Friends',
                'startDate' => new \DateTimeImmutable('2hours ago'),
                'endDate' => new \DateTimeImmutable('1hour ago'),
                'plannedDate' => null,
                'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_FRIENDS,
            ],
        ];
    }
}
