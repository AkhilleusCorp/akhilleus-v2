<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewHydrator\ViewHydratorInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;

abstract class AbstractMultipleObjectViewPresenter implements MultipleObjectViewPresenterInterface
{
    /**
     * @param DataModelInterface[]    $data
     * @param ViewHydratorInterface[] $hydrators
     */
    public function present(array $data, ?string $userType, array $hydrators = []): MultipleObjectViewModel
    {
        $viewModel = new MultipleObjectViewModel();
        foreach ($data as $item) {
            $viewModel->data[] = $this->presentItem($item, $userType);
        }

        foreach ($hydrators as $hydrator) {
            $viewModel->extra = array_merge($viewModel->extra, $hydrator->hydrate());
        }

        return $viewModel;
    }
}
