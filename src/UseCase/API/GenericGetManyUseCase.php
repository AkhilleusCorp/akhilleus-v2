<?php

namespace App\UseCase\API;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Factory\FilterModelFactory\GenericFilterModelFactory;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleEquipmentItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\GenericMultipleObjectViewPresenter;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;

final class GenericGetManyUseCase
{
    public function __construct(
        private readonly GenericFilterModelFactory $filterFactory,
        private readonly GenericViewPresenter $presenter
    ) {

    }

    public function execute(array $parameters, FilterModelInterface $filter, GenericDataModelProviderGateway $providerGateway): MultipleObjectViewModel
    {
        $filter = $this->filterFactory->buildGetManyFilterModel($parameters, $filter);
        $dataModels = $providerGateway->getByParameters($filter);

        $dataModelsCount = count($dataModels);
        if ($dataModelsCount === $filter->limit) {
            $dataModelsCount = $providerGateway->countByParameters($filter);
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