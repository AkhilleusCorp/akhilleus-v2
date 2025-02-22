<?php

namespace App\Domain\DTO\FilterModel\User;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\ApiDoc;

final class GetManyUsersFilterModel extends AbstractFilterModel implements FilterModelInterface
{
    /**
     * @var int[]
     */
    public ?array $ids = null;

    public ?string $username = null;

    public ?string $email = null;

    /** @var string[] */
    #[ApiDoc\Parameter(enum: UserTypeRegistry::USER_TYPES)]
    public array $type = [];

    /** @var string[] */
    #[ApiDoc\Parameter(enum: UserStatusRegistry::USER_STATUSES)]
    public array $status = [];
}
