<?php

namespace App\Tests\units\Infrastructure\Exception;

use App\Infrastructure\Exception\InvalidDataProfileException;
use PHPUnit\Framework\TestCase;

final class InvalidDataProfileExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $dataProfile = 'invalid-data-profile';

        $this->expectException(InvalidDataProfileException::class);
        $this->expectExceptionMessage("'{$dataProfile}' is not a valid data profile");

        throw new InvalidDataProfileException($dataProfile);
    }
}