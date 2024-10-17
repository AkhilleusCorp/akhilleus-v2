<?php

namespace App\Domain\Factory\DataModelFactory\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\DTO\SourceModel\User\UpdateUserSourceModel;
use App\Domain\Factory\DataModelFactory\AbstractDataModelFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataModelFactory extends AbstractDataModelFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    /**
     * @param CreateUserSourceModel $source
     */
    public function buildNewDataModel(CreateSourceModelInterface $source): UserDataModel
    {
        $user = new UserDataModel();
        $user->username = $source->username;
        $user->email = $source->email;
        $user->password = $this->hasher->hashPassword($user, $source->plainPassword);

        $user->lifecycle->registrationDate = new \DateTimeImmutable();
        $user->lifecycle->lastModificationDate = new \DateTimeImmutable();

        return $user;
    }

    /**
     * @param UserDataModel         $dataModel
     * @param UpdateUserSourceModel $sourceModel
     */
    public function mergeSourceAndDataModel(
        DataModelInterface $dataModel,
        UpdateSourceModelInterface $sourceModel,
    ): UserDataModel {
        /** @var UserDataModel $dataModel */
        $dataModel = parent::mergeSourceAndDataModel($dataModel, $sourceModel);

        $dataModel->lifecycle->lastModificationDate = new \DateTimeImmutable();

        return $dataModel;
    }
}
