<?php

namespace App\Domain\DTO\User;

class UserDTO
{
    public int $id;

    public string $login;
    public string $email;
    public string $password;
}