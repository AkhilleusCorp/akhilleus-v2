<?php

namespace App\UseCase\API\Workout;

use App\Domain\DTO\SourceModel\Workout\CreateWorkoutSourceModel;
use App\Domain\Factory\DataModelFactory\Workout\WorkoutDataModelFactory;
use App\Domain\Factory\SourceModelFactory;
use App\Domain\Gateway\Persister\Workout\WorkoutDataModelPersisterGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly SourceModelFactory $sourceModelFactory,
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
        /** @var CreateWorkoutSourceModel $source */
        $source = $this->sourceModelFactory->buildSourceFromParameters($parameters, new CreateWorkoutSourceModel());
        $workout = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($workout);

        return $this->presenter->present($workout, $payload->userType);
    }
}
