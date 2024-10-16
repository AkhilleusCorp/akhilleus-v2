<?php

namespace App\UseCase\API;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\Factory\DataModelFactory\DataModelFactoryInterface;
use App\Domain\Factory\SourceModelFactory\GenericSourceModelFactory;
use App\Infrastructure\Persister\GenericPersister;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;
use App\UseCase\UseCaseInterface;

final class GenericCreateOneUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly GenericSourceModelFactory $sourceModelFactory,
        private readonly GenericPersister $persister,
        private readonly GenericViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(
        array $parameters,
        SourceModelInterface $sourceModel,
        DataModelFactoryInterface $dataModelFactory,
        SingleObjectDataViewModelInterface $view,
    ): SingleObjectViewModel {
        /** @var CreateSourceModelInterface $source */
        $source = $this->sourceModelFactory->buildGenericSourceModel($parameters, $sourceModel);
        $dataModel = $dataModelFactory->buildNewDataModel($source);

        $this->persister->create($dataModel);

        return $this->presenter->presentSingleObject($dataModel, $view);
    }
}
