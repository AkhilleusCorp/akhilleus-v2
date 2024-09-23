<?php

namespace App\Domain\Registry\User;

interface UserStatusRegistry
{
    public const USER_STATUS_CREATED = 'created';
    public const USER_STATUS_ACTIVE = 'active';
    public const USER_STATUS_DEACTIVATED = 'deactivated';
    public const USER_STATUS_DELETED = 'deleted';
}