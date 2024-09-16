<?php

namespace App\Infrastructure\Exception;

final class InvalidDataProfileException extends \Exception
{
    public function __construct(string $dataProfile)
    {
        parent::__construct("{$dataProfile} is not a valid data profile");
    }
}