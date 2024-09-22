<?php

namespace App\Infrastructure\View\ViewModel;

final class PaginationViewModel
{
    public const DEFAULT_FIRST_PAGE = 1;

    public int $count;

    public int $firstPage = self::DEFAULT_FIRST_PAGE;

    public int $currentPage;

    public int $lastPage;

    public function __construct(int $count, int $currentPage, int $lastPage)
    {
        $this->count = $count;
        $this->currentPage = 0 === $this->count ? self::DEFAULT_FIRST_PAGE : $currentPage;
        $this->lastPage = 0 === $this->count ? self::DEFAULT_FIRST_PAGE : $lastPage;
    }
}