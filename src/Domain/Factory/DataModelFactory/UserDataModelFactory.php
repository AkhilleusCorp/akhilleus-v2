<?php

namespace App\Domain\Factory\DataModelFactory;

use App\Domain\DTO\DataModel\User\UserDataModel;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataModelFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }
    public function buildUserDataModel(string $login, string $email, string $plainPassword): UserDataModel
    {
        $user = new UserDataModel();
        $user->login = $login;
        $user->email = $email;
        $user->password = $this->hasher->hashPassword($user, $plainPassword);

        return $user;
    }
}