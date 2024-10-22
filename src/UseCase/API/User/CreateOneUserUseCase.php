<?php

namespace App\UseCase\API\User;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly CreateUserSourceModelFactory $sourceModelFactory,
        private readonly UserDataModelFactory $dataModelFactory,
        private readonly UserDataModelPersisterGateway $persister,
        private readonly SingleUserViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(
        array $parameters,
        ?TokenPayloadDTO $payload = null,
    ): SingleObjectViewModel {
        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        if (null === $source->userType && null !== $payload) {
            $source->userType = $payload->userType;
        }

        $user = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($user);

        return $this->presenter->present($user, $payload->userType);
    }
}
