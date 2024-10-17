<?php

namespace App\Domain\Factory\DataModelFactory\Workout;

use App\Domain\DTO\DataModel\Workout\ExerciseGroupDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\Workout\CreateExerciseGroupSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;

final class ExerciseGroupDataModelFactory extends AbstractDataModelFactory
{
    public function __construct(
        private readonly WorkoutDataModelProviderGateway $workoutProvider,
        private readonly MovementDataModelProviderGateway $movementProvider,
        private readonly ExerciseDataModelFactory $exerciseDataModelFactory,
    ) {
    }

    /**
     * @Todo use validation exception instead of generics
     *
     * @param CreateExerciseGroupSourceModel $source
     */
    public function buildNewDataModel(CreateSourceModelInterface $source): ExerciseGroupDataModel
    {
        $workout = $this->workoutProvider->getWorkoutById($source->workoutId);
        if (null === $workout) {
            throw new \LogicException("Workout #{$source->workoutId} could not be found");
        }

        $movements = $this->movementProvider->getGetMovementsByIds($source->movementIds);
        if (true === empty($movements) || count($source->movementIds) !== count($movements)) {
            throw new \LogicException('Some or all the movements provided could not be found');
        }

        $exerciseGroup = new ExerciseGroupDataModel();
        $exerciseGroup->workout = $workout;
        $exerciseGroup->movementIds = $source->movementIds;

        foreach ($movements as $movement) {
            $exercise = $this->exerciseDataModelFactory->buildNewDataModel($exerciseGroup, $movement);
            $exerciseGroup->exercises->add($exercise);
        }

        return $exerciseGroup;
    }
}
