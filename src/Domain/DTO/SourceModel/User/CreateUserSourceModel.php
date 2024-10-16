<?php

namespace App\Domain\DTO\SourceModel\User;

use App\Domain\DTO\SourceModel\CreateSourceModelInterface;

final class CreateUserSourceModel implements CreateSourceModelInterface
{
    public string $username;

    public string $email;

    public string $plainPassword;
}
