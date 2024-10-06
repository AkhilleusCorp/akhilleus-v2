<?php

namespace App\UseCase\API;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Factory\FilterModelFactory\GenericFilterModelFactory;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\Equipment\MultipleEquipmentItemDataViewModel;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;
use App\UseCase\UseCaseInterface;

final class GenericGetManyUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly GenericFilterModelFactory $filterFactory,
        private readonly GenericViewPresenter $presenter
    ) {

    }

    public function execute(array $parameters, FilterModelInterface $filter, GenericDataModelProviderGateway $providerGateway): MultipleObjectViewModel
    {
        $filter = $this->filterFactory->buildGetManyFilterModel($parameters, $filter);
        $dataModels = $providerGateway->getByFilterModel($filter)->getQuery()->getResult();

        $dataModelsCount = count($dataModels);
        if ($dataModelsCount === $filter->limit) {
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