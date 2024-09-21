<?php

namespace App\Domain\Factory\DataModelFactory\User;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\DTO\SourceModel\User\UpdateUserSourceModel;
use App\Domain\Factory\DataModelFactory\DataModelFactoryInterface;
use ReflectionClass;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataModelFactory implements DataModelFactoryInterface
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