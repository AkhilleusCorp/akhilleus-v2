<?php

namespace App\Domain\DTO\FilterModel\User;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\PaginationFilterTrait;
use App\Domain\DTO\FilterModel\SortsFilterTrait;

final class UsersFilterModel implements FilterModelInterface
{
    use PaginationFilterTrait;
    use SortsFilterTrait;

    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $username = null;

    public ?string $email = null;
}