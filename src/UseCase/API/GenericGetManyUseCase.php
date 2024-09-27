<?php

namespace App\UseCase\API;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Factory\FilterModelFactory\GenericFilterModelFactory;
use App\Infrastructure\Repository\AbstractBaseDTORepository;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\Workout\MultipleEquipmentItemViewModel;
use App\Infrastructure\View\ViewPresenter\GenericMultipleObjectViewPresenter;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;

final class GenericGetManyUseCase
{
    public function __construct(
        private readonly GenericFilterModelFactory $filterFactory,
        private readonly GenericViewPresenter $presenter
    ) {

    }

    public function execute(array $parameters, FilterModelInterface $filter, AbstractBaseDTORepository $repository): MultipleObjectViewModel
    {
        if (false === method_exists($repository, 'getByParameters')
            || false === method_exists($repository, 'countByParameters')) {
            throw new \LogicException('Cannot use "GenericGetManyUseCase" on this object');
        }

        $filter = $this->filterFactory->buildGetManyFilterModel($parameters, $filter);
        $dataModels = $repository->getByParameters($filter);

        $dataModelsCount = count($dataModels);
        if ($dataModelsCount === $filter->limit) {
            $dataModelsCount = $repository->countByParameters($filter);
        }

        return $this->presenter->presentMultipleObject(
            $dataModels,
            new MultipleEquipmentItemViewModel(),
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