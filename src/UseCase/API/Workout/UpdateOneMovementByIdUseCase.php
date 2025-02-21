<?php

namespace App\UseCase\API\Workout;

use App\Domain\DTO\SourceModel\Workout\UpdateMovementSourceModel;
use App\Domain\Factory\DataModelFactory\Workout\MovementDataModelFactory;
use App\Domain\Factory\SourceModelFactory\SourceModelFactory;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Persister\Workout\MovementDataModelPersister;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleMovementViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateOneMovementByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly SourceModelFactory $sourceModelFactory,
        private readonly MovementDataModelFactory $dataModelFactory,
        private readonly MovementDataModelProviderGateway $provider,
        private readonly MovementDataModelPersister $persister,
        private readonly SingleMovementViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(int $id, array $parameters, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $movement = $this->provider->getMovementById($id);
        if (null === $movement) {
            throw new NotFoundHttpException("Movement #$id cannot be found");
        }

        /** @var UpdateMovementSourceModel $source */
        $source = $this->sourceModelFactory->buildSourceFromParameters($parameters, new UpdateMovementSourceModel());
        $movement = $this->dataModelFactory->mergeSourceAndDataModel($movement, $source);

        $this->persister->edit($movement);

        return $this->presenter->present($movement, $payload->userType);
    }
}
