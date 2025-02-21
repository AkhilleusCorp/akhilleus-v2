<?php

namespace App\Domain\DTO\SourceModel\User;

use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractUserSourceModel
{
    #[Assert\NotBlank]
    public string $username;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
}
