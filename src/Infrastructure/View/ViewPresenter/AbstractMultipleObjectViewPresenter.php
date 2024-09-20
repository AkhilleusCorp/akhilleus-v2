<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Infrastructure\Exception\InvalidDataProfileException;
use App\Infrastructure\View\ViewHydrator\ViewHydratorInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectItemViewModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;

abstract class AbstractMultipleObjectViewPresenter
{
    /**
     * @param DataModelInterface[] $data
     * @param string $dataProfile
     * @param ViewHydratorInterface[] $hydrators
     *
     * @return MultipleObjectViewModel
     *
     * @throws InvalidDataProfileException
     */
    public function present(array $data, string $dataProfile, array $hydrators = []): MultipleObjectViewModel
    {
        $viewModel = new MultipleObjectViewModel();

        $methodName = 'presentFor' . ucfirst($dataProfile);
        if (false === method_exists($this, $methodName)) {
            throw new InvalidDataProfileException($dataProfile);
        }

        foreach ($data as $item) {
            $viewModel->data[] = $this->{$methodName}($item);
        }

        foreach ($hydrators as $hydrator) {
            $viewModel->extra = array_merge($viewModel->extra, $hydrator->hydrate());
        }

        return $viewModel;
    }


    protected abstract function presentForAdmin(DataModelInterface $data): MultipleObjectItemViewModelInterface;

    protected abstract function presentForMember(DataModelInterface $data): MultipleObjectItemViewModelInterface;
}