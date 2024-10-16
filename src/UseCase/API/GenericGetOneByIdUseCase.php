<?php

namespace App\UseCase\API;

use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GenericGetOneByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly GenericViewPresenter $presenter,
    ) {
    }

    public function execute(
        int $id,
        GenericDataModelProviderGateway $providerGateway,
        SingleObjectDataViewModelInterface $view,
    ): SingleObjectViewModel {
        $dataModel = $providerGateway->getOneById($id);
        if (null === $dataModel) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->presentSingleObject($dataModel, $view);
    }
}
