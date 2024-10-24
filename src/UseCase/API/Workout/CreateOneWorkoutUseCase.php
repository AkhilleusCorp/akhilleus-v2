<?php

namespace App\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\WorkoutDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateWorkoutSourceModelFactory;
use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly CreateWorkoutSourceModelFactory $sourceModelFactory,
        private readonly WorkoutDataModelFactory $dataModelFactory,
        private readonly WorkoutDataModelPersisterGateway $persister,
        private readonly SingleWorkoutViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(array $parameters, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $workout = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($workout);

        return $this->presenter->present($workout, $payload->userType);
    }
}
