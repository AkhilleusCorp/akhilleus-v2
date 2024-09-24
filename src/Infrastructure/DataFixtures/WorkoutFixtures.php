<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\SourceModel\Workout\CreateWorkoutSourceModel;
use App\Domain\Factory\DataModelFactory\Workout\WorkoutDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateWorkoutSourceModelFactory;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Domain\Registry\Workout\WorkoutVisibilityRegistry;
use Doctrine\Persistence\ObjectManager;

final class WorkoutFixtures extends AbstractFixtures
{
    public function __construct(
        private readonly CreateWorkoutSourceModelFactory $sourceModelFactory,
        private readonly WorkoutDataModelFactory         $dataModelFactory
    ) {
    }

    protected function explicitFixtures(ObjectManager $manager): void
    {
        /** @var CreateWorkoutSourceModel[] $sources */
        $sources = [];

        $sources[] = $this->sourceModelFactory->buildSourceModel(
            [
                'name' => 'InProgressPrivate',
                'status' => WorkoutStatusRegistry::WORKOUT_STATUS_IN_PROGRESS,
                'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PRIVATE
            ]
        );

        $sources[] = $this->sourceModelFactory->buildSourceModel(
            [
                'name' => 'PlanSpecificClient',
                'status' => WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED,
                'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_SPECIFIC_CLIENT
            ]
        );


        $sources[] = $this->sourceModelFactory->buildSourceModel(
            [
                'name' => 'CompletedFriends',
                'status' => WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED,
                'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_FRIENDS
            ]
        );

        foreach ($sources as $source) {
            $workout = $this->dataModelFactory->buildNewDataModel($source);
            $manager->persist($workout);
            $this->addReference("user-{$workout->name}", $workout);
        }
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        for ($i = 1; $i < 50; $i++) {
            $name = "workout{$i}";
            $source = $this->sourceModelFactory->buildSourceModel(
                [
                    'name' => $name,
                    'status' => WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED,
                    'visibility' => WorkoutVisibilityRegistry::WORKOUT_VISIBILITY_PUBLIC
                ]
            );

            $workout = $this->dataModelFactory->buildNewDataModel($source);
            $manager->persist($workout);

            $this->addReference("workout-{$name}", $workout);
        }
    }
}