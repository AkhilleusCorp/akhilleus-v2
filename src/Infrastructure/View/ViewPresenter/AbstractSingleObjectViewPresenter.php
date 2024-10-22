<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;

abstract class AbstractSingleObjectViewPresenter
{
    public function present(DataModelInterface $data, string $userType): SingleObjectViewModel
    {
        $view = new SingleObjectViewModel();
        $view->data = $this->presentViewData($data, $userType);

        return $view;
    }

    abstract public function presentViewData(DataModelInterface $data, string $userType): SingleObjectDataViewModelInterface;
}
