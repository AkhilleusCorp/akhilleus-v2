<?php

namespace App\UseCase\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\MovementDataModelFactory;
use App\Domain\Factory\SourceModelFactory\Workout\CreateMovementSourceModelFactory;
use App\Domain\Gateway\Persister\Workout\MovementDataModelPersisterGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneMovementUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly CreateMovementSourceModelFactory  $sourceModelFactory,
        private readonly MovementDataModelFactory          $dataModelFactory,
        private readonly MovementDataModelPersisterGateway $persister,
        private readonly SingleMovementViewPresenter       $presenter,
    ) {

    }

    public function execute(array $parameters, string $dateProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): SingleObjectViewModel
    {
        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $movement = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($movement);

        return $this->presenter->present($movement, $dateProfile);
    }
}