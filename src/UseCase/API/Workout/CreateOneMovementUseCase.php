<?php

namespace App\UseCase\API\Workout;

use App\Domain\DTO\SourceModel\Workout\CreateMovementSourceModel;
use App\Domain\Factory\DataModelFactory\Workout\MovementDataModelFactory;
use App\Domain\Factory\SourceModelFactory;
use App\Domain\Gateway\Persister\Workout\MovementDataModelPersisterGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneMovementUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly SourceModelFactory $sourceModelFactory,
        private readonly MovementDataModelFactory $dataModelFactory,
        private readonly MovementDataModelPersisterGateway $persister,
        private readonly SingleMovementViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(array $parameters, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        /** @var CreateMovementSourceModel $source */
        $source = $this->sourceModelFactory->buildSourceFromParameters($parameters, new CreateMovementSourceModel());
        $movement = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($movement);

        return $this->presenter->present($movement, $payload->userType);
    }
}
