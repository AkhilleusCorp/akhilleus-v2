<?php

namespace App\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\WorkoutDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateWorkoutSourceModelFactory;
use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly CreateWorkoutSourceModelFactory  $sourceModelFactory,
        private readonly WorkoutDataModelFactory          $dataModelFactory,
        private readonly WorkoutDataModelPersisterGateway $persister,
        private readonly SingleWorkoutViewPresenter       $presenter,
    ) {

    }

    public function execute(array $parameters, string $dateProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): SingleWorkoutViewModel
    {
        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $workout = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($workout);

        return $this->presenter->present($workout, $dateProfile);
    }
}