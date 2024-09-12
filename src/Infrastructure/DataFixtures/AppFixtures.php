<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\User\UserDTO;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 20; $i++) {
            $user = new UserDTO();
            $user->login = "login_{$i}";
            $user->email = "email_{$i}@fakemail.com";
            $user->password = $this->hasher->hashPassword($user, 'Test1234!');

            $manager->persist($user);
        }

        $manager->flush();
    }
}