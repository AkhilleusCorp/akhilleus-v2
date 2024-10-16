<?php

namespace App\Infrastructure\DataTransformer;

final class EmailObfuscationDataTransformer
{
    public static function obfuscate(string $email): string
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \LogicException("Can't obfuscate $email as it is not a valid email");
        }

        list($localPart, $domain) = explode('@', $email);

        $maskedLocalPart = substr($localPart, 0, 1).str_repeat('*', strlen($localPart) - 1);

        $lastDotPosition = strrpos($domain, '.');
        $domainName = substr($domain, 0, $lastDotPosition);
        $extension = substr($domain, $lastDotPosition);
        $maskedDomain = substr($domain, 0, 1).str_repeat('*', strlen($domainName) - 1);

        return $maskedLocalPart.'@'.$maskedDomain.$extension;
    }
}
