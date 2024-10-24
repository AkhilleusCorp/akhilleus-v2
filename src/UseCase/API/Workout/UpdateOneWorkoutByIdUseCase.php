<?php

namespace App\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\WorkoutDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\UpdateWorkoutSourceModelFactory;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Persister\Workout\WorkoutDataModelPersister;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateOneWorkoutByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UpdateWorkoutSourceModelFactory $sourceModelFactory,
        private readonly WorkoutDataModelFactory $dataModelFactory,
        private readonly WorkoutDataModelProviderGateway $provider,
        private readonly WorkoutDataModelPersister $persister,
        private readonly SingleWorkoutViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(int $id, array $parameters, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $workout = $this->provider->getWorkoutById($id);
        if (null === $workout) {
            throw new NotFoundHttpException("Workout #$id cannot be found");
        }

        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $workout = $this->dataModelFactory->mergeSourceAndDataModel($workout, $source);

        $this->persister->edit($workout);

        return $this->presenter->present($workout, $payload->userType);
    }
}
