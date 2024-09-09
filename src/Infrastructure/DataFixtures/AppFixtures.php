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
        for ($i = 0; $i < 20; $i++) {
            $user = new UserDTO();
            $user->login = '';
            $user->email = '';
            $user->password = $this->hasher->hashPassword($user, 'Test1234!');

            $manager->persist($user);
        }

        $manager->flush();
    }
}