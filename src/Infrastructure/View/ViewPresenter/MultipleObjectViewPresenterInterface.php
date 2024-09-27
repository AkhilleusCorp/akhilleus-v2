<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Infrastructure\View\ViewModel\MultipleObjectItemViewModelInterface;

interface MultipleObjectViewPresenterInterface
{
    public function presentItem(DataModelInterface $data, ?string $dataProfile): MultipleObjectItemViewModelInterface;
}