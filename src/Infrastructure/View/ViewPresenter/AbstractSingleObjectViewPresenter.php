<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\Exception\InvalidDataProfileException;
use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;

abstract class AbstractSingleObjectViewPresenter
{
    public function present(DataModelInterface $data, string $dataProfile): SingleObjectViewModelInterface
    {
        $methodName = 'presentFor' . ucfirst($dataProfile);
        if (true === method_exists($this, $methodName)) {
            return $this->{$methodName}($data);
        }

        throw new InvalidDataProfileException($dataProfile);
    }

    protected abstract function presentForAdmin(DataModelInterface $data): SingleObjectViewModelInterface;

    protected abstract function presentForMember(DataModelInterface $data): SingleObjectViewModelInterface;

}