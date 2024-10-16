<?php

namespace App\UseCase\API\User;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\Registry\DataProfileRegistry;
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
        string $dateProfile = DataProfileRegistry::DATA_PROFILE_MEMBER,
        string $userType = UserTypeRegistry::USER_TYPE_MEMBER,
    ): SingleObjectViewModel {
        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $user = $this->dataModelFactory->buildNewDataModel($source);
        $user->type = $userType;

        $this->persister->create($user);

        return $this->presenter->present($user, $dateProfile);
    }
}
