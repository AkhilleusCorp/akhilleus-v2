<?php

namespace App\UseCase\API\User;

use App\Domain\Factory\FilterModelFactory\User\UsersFilterModelModelFactory;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\User\MultipleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetManyUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDataModelProviderGateway $provider,
        private readonly UsersFilterModelModelFactory $filterFactory,
        private readonly MultipleUserViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(array $parameters, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): MultipleObjectViewModel
    {
        $filter = $this->filterFactory->buildGetManyUsersFilterModel($parameters);
        $users = $this->provider->getUsersByFilterModel($filter);

        $usersCount = count($users);
        if ($usersCount === $filter->limit) {
            $usersCount = $this->provider->countUsersByFilterModel($filter);
        }

        return $this->presenter->present(
            $users,
            $dataProfile,
            [
                new PaginationHydrator(
                    $usersCount,
                    $filter->page,
                    $filter->limit
                ),
            ]
        );
    }
}
