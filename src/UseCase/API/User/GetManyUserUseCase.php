<?php

namespace App\UseCase\API\User;

use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\Factory\FilterModelFactory\FilterModelFactory;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewPresenter\User\MultipleUserViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetManyUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDataModelProviderGateway $provider,
        private readonly FilterModelFactory $filterFactory,
        private readonly MultipleUserViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(array $parameters, ?TokenPayloadDTO $payload): MultipleObjectViewModel
    {
        /** @var GetManyUsersFilterModel $filter */
        $filter = $this->filterFactory->buildFilterFromParameters($parameters, new GetManyUsersFilterModel());
        $users = $this->provider->getUsersByFilterModel($filter);

        $usersCount = count($users);
        if ($usersCount === $filter->limit || PaginationViewModel::DEFAULT_FIRST_PAGE !== $filter->page) {
            $usersCount = $this->provider->countUsersByFilterModel($filter);
        }

        return $this->presenter->present(
            $users,
            $payload->userType,
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
