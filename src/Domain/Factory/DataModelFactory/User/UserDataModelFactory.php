<?php

namespace App\Domain\Factory\DataModelFactory\User;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\DTO\SourceModel\User\UpdateUserSourceModel;
use ReflectionClass;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataModelFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }
    public function buildNewUserDataModel(CreateUserSourceModel $model): UserDataModel
    {
        $user = new UserDataModel();
        $user->username = $model->username;
        $user->email = $model->email;
        $user->password = $this->hasher->hashPassword($user, $model->plainPassword);

        return $user;
    }

    public function mergeSourceAndDataModel(UserDataModel $user, UpdateUserSourceModel $model): UserDataModel
    {
        $reflexion = new ReflectionClass(UpdateUserSourceModel::class);
        foreach ($reflexion->getProperties() as $property) {
            $propertyName = $property->getName();
            if (property_exists($user, $propertyName)) {
                $user->{$propertyName} = $model->{$propertyName};
            }
        }

        return $user;
    }
}