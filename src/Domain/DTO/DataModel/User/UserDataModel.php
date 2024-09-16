<?php

namespace App\Domain\DTO\DataModel\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity()]
#[ORM\Table(name: 'USER')]
class UserDataModel implements DataModelInterface, PasswordAuthenticatedUserInterface
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