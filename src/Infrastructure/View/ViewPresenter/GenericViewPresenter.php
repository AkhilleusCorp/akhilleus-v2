<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewHydrator\ViewHydratorInterface;
use App\Infrastructure\View\ViewModel\DataViewModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectItemDataViewModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;

final class GenericViewPresenter
{
    /** @var \ReflectionProperty[] */
    private ?array $reflectionProperties = null;

    public function presentSingleObject(
        DataModelInterface $model,
        SingleObjectDataViewModelInterface $viewData,
    ): SingleObjectViewModel {
        $view = new SingleObjectViewModel();
        $view->data = $this->presentByReflection($model, $viewData);

        return $view;
    }

    /**
     * @param DataModelInterface[]    $models
     * @param ViewHydratorInterface[] $hydrators
     */
    public function presentMultipleObject(array $models, MultipleObjectItemDataViewModelInterface $view, array $hydrators = []): MultipleObjectViewModel
    {
        $viewModel = new MultipleObjectViewModel();

        foreach ($models as $model) {
            $view = $this->presentByReflection($model, clone $view);
            $viewModel->data[] = $view;
        }

        foreach ($hydrators as $hydrator) {
            $viewModel->extra = array_merge($viewModel->extra, $hydrator->hydrate());
        }

        return $viewModel;
    }

    private function presentByReflection(DataModelInterface $model, SingleObjectDataViewModelInterface|MultipleObjectItemDataViewModelInterface $view): SingleObjectDataViewModelInterface|MultipleObjectItemDataViewModelInterface
    {
        foreach ($this->getReflectionProperties($view) as $property) {
            $propertyName = $property->getName();
            if (property_exists($model, $propertyName)) {
                $view->{$propertyName} = $model->{$propertyName};
            }
        }

        return $view;
    }

    /** @return \ReflectionProperty[] */
    private function getReflectionProperties(DataViewModelInterface $view): array
    {
        if (null !== $this->reflectionProperties) {
            return $this->reflectionProperties;
        }

        $reflection = new \ReflectionClass($view);
        $this->reflectionProperties = $reflection->getProperties();

        return $this->reflectionProperties;
    }
}
