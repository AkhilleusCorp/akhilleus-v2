<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewModel\DataViewModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;

final class GenericViewPresenter
{
    public function presentSingleObject(
        DataModelInterface                 $data,
        SingleObjectDataViewModelInterface $viewData
    ): SingleObjectViewModel {
        $view = new SingleObjectViewModel();
        $view->data = $this->presentByReflection($data, $viewData);

        return $view;
    }

    public function presentMultipleObject(array $data, MultipleObjectItemDataViewModelInterface $view, array $hydrators = []): MultipleObjectViewModel
    {
        $viewModel = new MultipleObjectViewModel();
        foreach ($data as $item) {
            $viewModel->data[] = $this->presentByReflection($item, $view);
        }

        foreach ($hydrators as $hydrator) {
            $viewModel->extra = array_merge($viewModel->extra, $hydrator->hydrate());
        }

        return $viewModel;
    }

    private function presentByReflection(DataModelInterface $data, DataViewModelInterface $view): DataViewModelInterface
    {
        $reflection = new \ReflectionClass($view);
        foreach ($reflection->getProperties() as $property) {
            $propertyName = $property->getName();
            if (property_exists($data, $propertyName)) {
                $view->{$propertyName} = $data->{$propertyName};
            }
        }

        return $view;
    }
}