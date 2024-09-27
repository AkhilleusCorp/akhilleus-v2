<?php

namespace App\UseCase\API;

use App\Infrastructure\Repository\AbstractBaseDTORepository;
use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;
use App\Infrastructure\View\ViewPresenter\GenericViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GenericGetOneByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly GenericViewPresenter $presenter
    ) {

    }

    public function execute(int $id, AbstractBaseDTORepository $repository, SingleObjectViewModelInterface $view): SingleObjectViewModelInterface
    {
        if (false === method_exists($repository, 'getOneById')) {
            throw new \LogicException('Cannot use "GenericGetOneByIdUseCase" on this object');
        }

        $data = $repository->getOneById($id);
        if (null === $data) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->presentSingleObject($data, $view);
    }
}