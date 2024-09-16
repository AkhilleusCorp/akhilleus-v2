<?php

namespace App\UseCase\User;

use App\Domain\Factory\DataModelFactory\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use App\Infrastructure\Persister\User\UserDTOPersister;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneUserByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly CreateUserSourceModelFactory $createSourceModel,
        private readonly UserDataModelFactory $factory,
        private readonly UserDTOPersister $persister,
        private readonly SingleUserViewPresenter $presenter,
    ) {

    }
    public function execute(array $parameters, string $dateProfile): SingleUserViewModel
    {
        $source = $this->createSourceModel->buildCreateUserSourceModel($parameters);
        $user = $this->factory->buildUserDataModel($source);

        $this->persister->create($user);

        return $this->presenter->present($user, $dateProfile);
    }
}