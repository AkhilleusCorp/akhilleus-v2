<?php

namespace App\UseCase\API;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;
use App\Domain\Factory\DataModelFactory\DataModelFactoryInterface;
use App\Domain\Factory\SourceModelFactory\GenericSourceModelFactory;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\Persister\GenericPersister;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GenericUpdateOneByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly GenericSourceModelFactory $sourceModelFactory,
        private readonly GenericPersister $persister,
        private readonly GenericViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed>               $parameters
     * @param UpdateSourceModelInterface $sourceModel
     */
    public function execute(
        int $id,
        array $parameters,
        GenericDataModelProviderGateway $providerGateway,
        SourceModelInterface $sourceModel,
        DataModelFactoryInterface $dataModelFactory,
        SingleObjectDataViewModelInterface $view,
    ): SingleObjectViewModel {
        $data = $providerGateway->getOneById($id);
        if (null === $data) {
            throw new NotFoundHttpException();
        }

        /** @var UpdateSourceModelInterface $source */
        $source = $this->sourceModelFactory->buildGenericSourceModel($parameters, $sourceModel);
        $dataModel = $dataModelFactory->mergeSourceAndDataModel($data, $source);

        $this->persister->edit($data);

        return $this->presenter->presentSingleObject($dataModel, $view);
    }
}
