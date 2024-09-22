<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends Fixture
{
    private const DEFAULT_PASSWORD = 'Test1234!';

    public function __construct(
        private readonly CreateUserSourceModelFactory $sourceModelFactory,
        private readonly UserDataModelFactory $dataModelFactory
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->explicitFixtures($manager);
        $this->volumeFixtures($manager);

        $manager->flush();
    }

    private function explicitFixtures(ObjectManager $manager): void
    {
        $usernames = ['ghriim', 'camillou', 'g.host'];

        foreach ($usernames as $username) {
            $source = $this->sourceModelFactory->buildSourceModel([
                'username' => $username,
                'email' => "{$username}@fakemail.com",
                'plainPassword' => self::DEFAULT_PASSWORD,
            ]);

            $user = $this->dataModelFactory->buildNewDataModel($source);
            $manager->persist($user);
        }
    }

    private function volumeFixtures(ObjectManager $manager): void
    {
        for ($i = 1; $i < 50; $i++) {
            $username = "username{$i}";
            $source = $this->sourceModelFactory->buildSourceModel([
                'username' => $username,
                'email' => "{$username}@fakemail.com",
                'plainPassword' => self::DEFAULT_PASSWORD,
            ]);

            $user = $this->dataModelFactory->buildNewDataModel($source);
            $manager->persist($user);

            $this->addReference("user-{$username}", $user);
        }
    }
}