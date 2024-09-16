<?php

namespace App\Domain\DTO\FilterModel;

trait PaginationFilterTrait
{
    public const DEFAULT_LIMIT = 10;
    public const DEFAULT_PAGE = 1;

    public int $limit = self::DEFAULT_LIMIT;

    public int $page = self::DEFAULT_PAGE;
}