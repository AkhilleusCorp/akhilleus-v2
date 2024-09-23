<?php

namespace App\Domain\Registry\User;

interface UserTypeRegistry
{
    const USER_TYPE_MEMBER = 'member';
    const USER_TYPE_COACH = 'coach';
    const USER_TYPE_ADMIN = 'admin';
}