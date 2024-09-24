<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\DataModel\User\UserDataModel;
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
        /** @var UserDataModel[] $users */
        $users = [];
        $source = $this->buildBaseUserInformation('ghriim');

        $ghriim = $this->dataModelFactory->buildNewDataModel($source);
        $ghriim->status = UserStatusRegistry::USER_STATUS_ACTIVE;
        $users[] = $ghriim;

        $source = $this->buildBaseUserInformation('coach');

        $coach = $this->dataModelFactory->buildNewDataModel($source);
        $coach->status = UserStatusRegistry::USER_STATUS_ACTIVE;
        $coach->type = UserTypeRegistry::USER_TYPE_COACH;
        $users[] = $coach;

        $source = $this->buildBaseUserInformation('admin');

        $admin = $this->dataModelFactory->buildNewDataModel($source);
        $admin->status = UserStatusRegistry::USER_STATUS_ACTIVE;
        $admin->type = UserTypeRegistry::USER_TYPE_ADMIN;
        $users[] = $admin;

        foreach ($users as $user) {
            $manager->persist($user);
            $this->addReference("user-".$user->username, $user);
        }
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
            $this->addReference("user-{$user->username}", $user);
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