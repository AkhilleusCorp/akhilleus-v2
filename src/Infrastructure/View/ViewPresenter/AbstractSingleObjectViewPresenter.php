<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;

abstract class AbstractSingleObjectViewPresenter
{
    public function present(DataModelInterface $data, string $dataProfile): SingleObjectViewModel
    {
        $view = new SingleObjectViewModel();
        $view->data = $this->presentViewData($data, $dataProfile);

        return $view;
    }

    public abstract function presentViewData(DataModelInterface $data, string $dataProfile): SingleObjectDataViewModelInterface;
}