<?php

namespace App\Domain\DTO\SourceModel\User;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use App\Domain\DTO\SourceModel\UpdateSourceModelInterface;

final class UpdateUserSourceModel implements UpdateSourceModelInterface
{
    public string $username;

    public string $email;

    public string $status;
}