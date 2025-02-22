<?php

namespace App\UseCase\API;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\Factory\FilterModelFactory\FilterModelFactory;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\Equipment\MultipleEquipmentItemDataViewModel;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;
use App\UseCase\UseCaseInterface;

final class GenericFetchManyUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly FilterModelFactory $filterFactory,
        private readonly GenericViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(array $parameters, AbstractFilterModel $filter, GenericDataModelProviderGateway $providerGateway): MultipleObjectViewModel
    {
        /** @var AbstractFilterModel $filter */
        $filter = $this->filterFactory->buildFilterFromParameters($parameters, $filter);
        $dataModels = $providerGateway->getByFilterModel($filter)->getQuery()->getResult();

        $dataModelsCount = count($dataModels);
        if ($dataModelsCount === $filter->limit || PaginationViewModel::DEFAULT_FIRST_PAGE !== $filter->page) {
            $dataModelsCount = $providerGateway->countByFilterModel($filter);
        }

        return $this->presenter->presentMultipleObject(
            $dataModels,
            new MultipleEquipmentItemDataViewModel(),
            [
                new PaginationHydrator(
                    $dataModelsCount,
                    $filter->page,
                    $filter->limit
                ),
            ]
        );
    }
}
