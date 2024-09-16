<?php

namespace App\UseCase\User;

use App\Domain\Factory\FilterModelFactory\User\UsersFilterModelModelFactory;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\User\MultipleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetManyUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDTOProviderGateway       $provider,
        private readonly UsersFilterModelModelFactory $filterFactory,
        private readonly MultipleUserViewPresenter $presenter,
    ) {

    }

    public function execute(array $parameters, string $dataProfile): MultipleObjectViewModel
    {
        $filter = $this->filterFactory->buildUserFilterModel($parameters);
        $users = $this->provider->getUsersByParameters($filter);
        $usersCount = $this->provider->countUsersByParameters($filter);

        return $this->presenter->present(
            $users,
            $usersCount,
            $filter,
            $dataProfile,
        );
    }
}