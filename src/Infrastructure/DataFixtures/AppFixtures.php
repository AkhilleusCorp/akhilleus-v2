<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\DTO\SourceModel\User\CreateUserSourceModel;
use App\Domain\Factory\DataModelFactory\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AppFixtures extends Fixture
{
    public function __construct(
        private readonly CreateUserSourceModelFactory $createSourceModel,
        private readonly UserDataModelFactory $userFactory
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 20; $i++) {
            $login = 'login' . $i;
            $source = $this->createSourceModel->buildCreateUserSourceModel([
                'login' => $login,
                'email' => "{$login}@fakemail.com",
                'plainPassword' => 'password' . $i,
            ]);

            $user = $this->userFactory->buildUserDataModel($source);
            $manager->persist($user);
        }

        $manager->flush();
    }
}