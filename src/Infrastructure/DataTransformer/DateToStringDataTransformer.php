<?php

namespace App\Infrastructure\DataTransformer;

final class DateToStringDataTransformer
{
    private const FORMAT_M_D_Y = 'm-d-Y';

    public static function toString(?\DateTimeInterface $dateTime, bool $withTime = true): ?string
    {
        if (null === $dateTime) {
            return null;
        }

        $format = self::FORMAT_M_D_Y;
        if (true === $withTime) {
            $format = "{$format} h:i:s";
        }

        return $dateTime->format($format);
    }
}