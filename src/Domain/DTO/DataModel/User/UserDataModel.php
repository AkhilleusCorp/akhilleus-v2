<?php

namespace App\Domain\DTO\DataModel\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\Registry\UserTypeRegistry;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity()]
#[ORM\Table(name: 'USER')]
class UserDataModel implements DataModelInterface, UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(type: Types::STRING, length: 50, unique: true)]
    public string $username;

    #[ORM\Column(type: Types::STRING, length: 150, unique: true)]
    public string $email;

    #[ORM\Column(type: Types::STRING, length: 255)]
    public string $password;

    #[ORM\Column(type: Types::STRING, length: 10, unique: false)]
    public string $type = UserTypeRegistry::USER_TYPE_MEMBER;

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}