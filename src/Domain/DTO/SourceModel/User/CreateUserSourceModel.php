<?php

namespace App\Domain\DTO\SourceModel\User;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;
use App\Domain\Registry\User\UserTypeRegistry;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateUserSourceModel extends AbstractUserSourceModel implements CreateSourceModelInterface
{
    #[Assert\NotBlank]
    public string $plainPassword;

    #[Assert\Choice(choices: UserTypeRegistry::USER_TYPES)]
    public string $userType = UserTypeRegistry::USER_TYPE_MEMBER;
}
