<?php

namespace App\Domain\Factory\DataModelFactory\User;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserAbstractDataModelFactory extends AbstractDataModelFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }
    public function buildNewDataModel(CreateUserSourceModel|SourceModelInterface $source): UserDataModel
    {
        $user = new UserDataModel();
        $user->username = $source->username;
        $user->email = $source->email;
        $user->password = $this->hasher->hashPassword($user, $source->plainPassword);

        return $user;
    }
}