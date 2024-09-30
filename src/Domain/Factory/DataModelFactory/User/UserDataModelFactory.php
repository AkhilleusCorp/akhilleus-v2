<?php

namespace App\Domain\Factory\DataModelFactory\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\DTO\SourceModel\User\UpdateUserSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;
use DateTimeImmutable;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataModelFactory extends AbstractDataModelFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }
    public function buildNewDataModel(CreateUserSourceModel|CreateSourceModelInterface $source): UserDataModel
    {
        $user = new UserDataModel();
        $user->username = $source->username;
        $user->email = $source->email;
        $user->password = $this->hasher->hashPassword($user, $source->plainPassword);

        $user->lifecycle->registrationDate = new DateTimeImmutable(false);
        $user->lifecycle->lastModificationDate = new DateTimeImmutable(false);

        return $user;
    }

    public function mergeSourceAndDataModel(
        UserDataModel|DataModelInterface $dataModel,
        UpdateUserSourceModel|UpdateSourceModelInterface $sourceModel,
    ): DataModelInterface {
        /** @var UserDataModel $dataModel */
        $dataModel = parent::mergeSourceAndDataModel($dataModel, $sourceModel);

        $dataModel->lifecycle->lastModificationDate = new DateTimeImmutable(false);

        return $dataModel;
    }
}