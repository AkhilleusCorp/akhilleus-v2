<?php

namespace App\Domain\DTO\User;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity()]
#[ORM\Table(name: 'USER')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class UserDTO implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(type: Types::STRING, length: 50, unique: true)]
    public string $login;

    #[ORM\Column(type: Types::STRING, length: 150, unique: true)]
    public string $email;

    #[ORM\Column(type: Types::STRING, length: 255)]
    public string $password;

    public function getPassword(): ?string
    {
        return $this->password;
    }
}