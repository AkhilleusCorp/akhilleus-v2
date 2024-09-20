<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends Fixture
{
    public function __construct(
        private readonly CreateUserSourceModelFactory $sourceModelFactory,
        private readonly UserDataModelFactory $dataModelFactory
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 50; $i++) {
            $username = "username{$i}";
            $source = $this->sourceModelFactory->buildSourceModel([
                'username' => $username,
                'email' => "{$username}@fakemail.com",
                'plainPassword' => 'password' . $i,
            ]);

            $user = $this->dataModelFactory->buildNewUserDataModel($source);
            $manager->persist($user);

            $this->addReference("user-{$username}", $user);
        }

        $manager->flush();
    }
}