<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewHydrator\ViewHydratorInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;

abstract class AbstractMultipleObjectViewPresenter
{
    /**
     * @param DataModelInterface[] $data
     * @param ?string $dataProfile
     * @param ViewHydratorInterface[] $hydrators
     *
     * @return MultipleObjectViewModel
     */
    public function present(array $data, ?string $dataProfile, array $hydrators = []): MultipleObjectViewModel
    {
        $viewModel = new MultipleObjectViewModel();
        foreach ($data as $item) {
            $viewModel->data[] = $this->presentItem($item, $dataProfile);
        }

        foreach ($hydrators as $hydrator) {
            $viewModel->extra = array_merge($viewModel->extra, $hydrator->hydrate());
        }

        return $viewModel;
    }

}