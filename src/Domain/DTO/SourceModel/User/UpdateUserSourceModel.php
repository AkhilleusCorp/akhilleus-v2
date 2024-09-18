<?php

namespace App\Domain\DTO\SourceModel\User;

use App\Domain\DTO\SourceModel\SourceModelInterface;

final class UpdateUserSourceModel implements SourceModelInterface
{
    public string $login;

    public string $email;
}