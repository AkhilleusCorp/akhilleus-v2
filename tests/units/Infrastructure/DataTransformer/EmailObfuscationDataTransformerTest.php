<?php

namespace App\Tests\units\Infrastructure\DataTransformer;

use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use PHPUnit\Framework\TestCase;

final class EmailObfuscationDataTransformerTest extends TestCase
{
    /**
     * @dataProvider validEmailDataProvider
     */
    public function testWithValidEmail(string $validEmail, string $expectedResult): void
    {
        $result = EmailObfuscationDataTransformer::obfuscate($validEmail);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider invalidEmailDataProvider
     */
    public function testWithInvalidEmail(string $invalidEmail): void
    {
        $this->expectException(\LogicException::class);

        EmailObfuscationDataTransformer::obfuscate($invalidEmail);
    }

    /**
     * @return array<mixed>
     */
    public function validEmailDataProvider(): array
    {
        return [
            ['test@test.com', 't***@t***.com'],
            ['bob-is-great@fakemail.fr', 'b***********@f*******.fr'],
            ['garry.host@incognito.io', 'g*********@i********.io'],
        ];
    }

    /**
     * @return array<mixed>
     */
    public function invalidEmailDataProvider(): array
    {
        return [
            ['this-is-not-an-email'],
            ['this-is-not-an-email@mail'],
            ['this-is-not-an-email.com'],
            ['@test.com'],
        ];
    }
}
