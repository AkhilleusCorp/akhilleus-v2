<?php

namespace App\Domain\DTO\FilterModel\User;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\PaginationFilterTrait;
use App\Domain\DTO\FilterModel\SortsFilterTrait;

final class GetManyUsersFilterModel implements FilterModelInterface
{
    use PaginationFilterTrait;
    use SortsFilterTrait;

    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $username = null;

    public ?string $email = null;

    /** @var string[] */
    public ?array $types = null;

    /** @var string[] */
    public ?array $statuses = null;
}