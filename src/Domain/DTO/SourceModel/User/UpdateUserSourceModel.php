<?php

namespace App\Domain\DTO\SourceModel\User;

use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;
use App\Domain\Registry\User\UserStatusRegistry;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdateUserSourceModel extends AbstractUserSourceModel implements UpdateSourceModelInterface
{
    #[Assert\Choice(choices: UserStatusRegistry::USER_STATUSES)]
    public string $status;
}
