<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;

interface SingleObjectViewPresenterInterface
{
    public function present(DataModelInterface $data, string $dataProfile): SingleObjectViewModelInterface;
}