<?php

namespace App\UseCase\User;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly CreateUserSourceModelFactory  $sourceModelFactory,
        private readonly UserDataModelFactory          $dataModelFactory,
        private readonly UserDataModelPersisterGateway $persister,
        private readonly SingleUserViewPresenter       $presenter,
    ) {

    }
    public function execute(array $parameters, string $dateProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): SingleUserViewModel
    {
        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $user = $this->dataModelFactory->buildNewDataModel($source);

        $this->persister->create($user);

        return $this->presenter->present($user, $dateProfile);
    }
}