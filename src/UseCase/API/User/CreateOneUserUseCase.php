<?php

namespace App\UseCase\API\User;

use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\SourceModelFactory;
use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly SourceModelFactory $sourceModelFactory,
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
        /** @var CreateUserSourceModel $source */
        $source = $this->sourceModelFactory->buildSourceFromParameters($parameters, new CreateUserSourceModel());
        if (null === $source->userType && null !== $payload) {
            $source->userType = $payload->userType;
        }

        $user = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($user);

        return $this->presenter->present($user, null === $payload ? $user->type : $payload->userType);
    }
}
