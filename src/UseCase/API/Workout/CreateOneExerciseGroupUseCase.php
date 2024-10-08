<?php

namespace App\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\ExerciseGroupDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateExerciseGroupSourceModelFactory;
use App\Domain\Gateway\Persister\Workout\ExerciseGroupDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleExerciseGroupViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class CreateOneExerciseGroupUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly CreateExerciseGroupSourceModelFactory $sourceModelFactory,
        private readonly ExerciseGroupDataModelFactory $dataModelFactory,
        private readonly ExerciseGroupDataModelPersisterGateway $persister,
        private readonly SingleExerciseGroupViewPresenter $presenter,
    ) {

    }

    public function execute(int $workoutId, array $parameters, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): SingleObjectViewModel
    {
        $parameters['workoutId'] = $workoutId;
        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $exerciseGroup = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($exerciseGroup);

        return $this->presenter->present(
            $exerciseGroup,
            $dataProfile
        );
    }
}