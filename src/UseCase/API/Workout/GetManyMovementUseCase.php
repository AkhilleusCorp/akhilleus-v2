<?php

namespace App\UseCase\API\Workout;

use App\Domain\Factory\FilterModelFactory\Workout\MovementsFilterModelModelFactory;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleMovementViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetManyMovementUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly MovementDataModelProviderGateway $provider,
        private readonly MovementsFilterModelModelFactory $filterFactory,
        private readonly MultipleMovementViewPresenter    $presenter,
    ) {

    }

    public function execute(array $parameters, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): MultipleObjectViewModel
    {
        $filter = $this->filterFactory->buildGetManyMovementsFilterModel($parameters);
        $movements = $this->provider->getMovementsByFilterModel($filter);

        $movementsCount = count($movements);
        if ($movementsCount === $filter->limit) {
            $movementsCount = $this->provider->countMovementsByFilterModel($filter);
        }

        return $this->presenter->present(
            $movements,
            $dataProfile,
            [
                new PaginationHydrator(
                    $movementsCount,
                    $filter->page,
                    $filter->limit
                ),
            ]
        );
    }
}