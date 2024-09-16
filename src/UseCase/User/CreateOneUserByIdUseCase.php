<?php

namespace App\UseCase\User;

use App\Domain\Factory\DataModelFactory\UserDataModelFactory;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class CreateOneUserByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDataModelFactory $factory,
        private readonly SingleUserViewPresenter $presenter,
    ) {

    }
    public function execute(array $parameters, string $dateProfile): SingleUserViewModel
    {
        $user = $this->factory->buildUserDataModel('', '', '');

        return $this->presenter->present($user, $dateProfile);
    }
}