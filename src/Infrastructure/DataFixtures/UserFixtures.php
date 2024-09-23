<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends AbstractFixtures
{
    private const DEFAULT_PASSWORD = 'Test1234!';

    public function __construct(
        private readonly CreateUserSourceModelFactory $sourceModelFactory,
        private readonly UserDataModelFactory         $dataModelFactory
    ) {
    }

    protected function explicitFixtures(ObjectManager $manager): void
    {
        $source = $this->buildBaseUserInformation('ghriim');

        $user = $this->dataModelFactory->buildNewDataModel($source);
        $user->status = UserStatusRegistry::USER_STATUS_ACTIVE;
        $manager->persist($user);

        $source = $this->buildBaseUserInformation('coach');

        $user = $this->dataModelFactory->buildNewDataModel($source);
        $user->status = UserStatusRegistry::USER_STATUS_ACTIVE;
        $user->type = UserTypeRegistry::USER_TYPE_COACH;
        $manager->persist($user);


        $source = $this->buildBaseUserInformation('admin');

        $user = $this->dataModelFactory->buildNewDataModel($source);
        $user->status = UserStatusRegistry::USER_STATUS_ACTIVE;
        $user->type = UserTypeRegistry::USER_TYPE_ADMIN;
        $manager->persist($user);
    }

    protected function volumeFixtures(ObjectManager $manager): void
    {
        for ($i = 1; $i < 50; $i++) {
            $username = "username{$i}";
            $source = $this->buildBaseUserInformation($username);

            $user = $this->dataModelFactory->buildNewDataModel($source);
            if ($i <= 40) {
                $user->status = UserStatusRegistry::USER_STATUS_ACTIVE;
            }
            $manager->persist($user);

            $this->addReference("user-{$username}", $user);
        }
    }

    private function buildBaseUserInformation(string $username): CreateUserSourceModel
    {
        return $this->sourceModelFactory->buildSourceModel([
            'username' => $username,
            'email' => "{$username}@fakemail.com",
            'plainPassword' => self::DEFAULT_PASSWORD,
        ]);
    }
}