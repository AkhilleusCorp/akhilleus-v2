<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectItemViewModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;
use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class GenericViewPresenter
{
    public function presentSingleObject(
        DataModelInterface $data,
        SingleObjectViewModelInterface $view
    ): SingleObjectViewModelInterface {
        return $this->presentByReflection($data, $view);
    }

    public function presentMultipleObject(array $data, MultipleObjectItemViewModelInterface $view, array $hydrators = []): MultipleObjectViewModel
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

    private function presentByReflection(DataModelInterface $data, ViewModelInterface $view): ViewModelInterface
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