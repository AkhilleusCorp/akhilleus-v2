<?php

namespace App\Domain\DTO\FilterModel;

trait PaginationFilterTrait
{
    public const DEFAULT_LIMIT = 10;

    public ?int $limit = self::DEFAULT_LIMIT;

    public ?int $page = null;
}