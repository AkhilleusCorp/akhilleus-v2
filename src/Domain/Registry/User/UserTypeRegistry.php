<?php

namespace App\Domain\Registry\User;

interface UserTypeRegistry
{
    public const USER_TYPE_MEMBER = 'member';
    public const USER_TYPE_COACH = 'coach';
    public const USER_TYPE_ADMIN = 'admin';

    public const USER_TYPES = [
        self::USER_TYPE_MEMBER,
        self::USER_TYPE_COACH,
        self::USER_TYPE_ADMIN,
    ];
}
