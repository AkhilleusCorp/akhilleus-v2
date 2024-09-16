<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Factory\DataModelFactory\UserDataModelFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AppFixtures extends Fixture
{
    public function __construct(private readonly UserDataModelFactory $userFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 20; $i++) {
            $login = 'login' . $i;
            $email = "{$login}@fakemail.com";
            $plainPassword = 'password' . $i;

            $user = $this->userFactory->buildUserDataModel($login, $email, $plainPassword);
            $manager->persist($user);
        }

        $manager->flush();
    }
}