<?php

namespace App\Infrastructure\View\ViewHydrator;

use App\Infrastructure\View\ViewModel\PaginationViewModel;

final class PaginationHydrator implements ViewHydratorInterface
{
    public function __construct(private int $count, private int $page, private int $limit)
    {
    }

    public function hydrate(): array
    {
        $pagination = new PaginationViewModel(
            $this->count,
            $this->page,
            (int) ceil($this->count / $this->limit)
        );

        return ['pagination' => $pagination];
    }
}
