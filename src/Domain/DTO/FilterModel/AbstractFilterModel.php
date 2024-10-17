<?php

namespace App\Domain\DTO\FilterModel;

abstract class AbstractFilterModel implements FilterModelInterface
{
    public const DEFAULT_LIMIT = 25;
    public const DEFAULT_PAGE = 1;

    public int $limit = self::DEFAULT_LIMIT;

    public int $page = self::DEFAULT_PAGE;

    /**
     * @var string[]
     */
    public array $sorts = [];
}
