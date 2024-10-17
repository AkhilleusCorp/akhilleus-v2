<?php

namespace App\Infrastructure\View\ViewModel;

use Symfony\Component\Serializer\Attribute\Groups;

final class PaginationViewModel
{
    public const DEFAULT_FIRST_PAGE = 1;

    #[Groups(['admin', 'coach', 'member'])]
    public int $count;

    #[Groups(['admin', 'coach', 'member'])]
    public int $firstPage = self::DEFAULT_FIRST_PAGE;

    #[Groups(['admin', 'coach', 'member'])]
    public int $currentPage;

    #[Groups(['admin', 'coach', 'member'])]
    public int $lastPage;

    public function __construct(int $count, int $currentPage, int $lastPage)
    {
        $this->count = $count;
        $this->currentPage = 0 === $this->count ? self::DEFAULT_FIRST_PAGE : $currentPage;
        $this->lastPage = 0 === $this->count ? self::DEFAULT_FIRST_PAGE : $lastPage;
    }
}
