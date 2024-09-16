<?php

namespace App\Domain\Factory\DataModelFactory;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataModelFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }
    public function buildUserDataModel(CreateUserSourceModel $model): UserDataModel
    {
        $user = new UserDataModel();
        $user->login = $model->login;
        $user->email = $model->email;
        $user->password = $this->hasher->hashPassword($user, $model->plainPassword);

        return $user;
    }
}