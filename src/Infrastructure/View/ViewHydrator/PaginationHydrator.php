<?php

namespace App\Infrastructure\View\ViewHydrator;

final class PaginationHydrator implements ViewHydratorInterface
{
    private const DEFAULT_FIRST_PAGE = 1;

    public function __construct(private int $count, private int $page, private int $limit)
    {

    }

    public function hydrate(): array
    {
        $lastPage = ceil($this->count / $this->limit);

        return [ 'pagination' =>
            [
                'count' => $this->count,
                'firstPage' => self::DEFAULT_FIRST_PAGE,
                'currentPage' => $this->page,
                'lastPage' => 0 === $this->count ? self::DEFAULT_FIRST_PAGE : $lastPage
            ]
        ];
    }
}