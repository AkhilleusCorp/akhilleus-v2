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
        return [ 'pagination' =>
            [
                'count' => $this->count,
                'firstPage' => self::DEFAULT_FIRST_PAGE,
                'currentPage' => $this->page,
                'lastPage' => ceil($this->count / $this->limit)
            ]
        ];
    }
}