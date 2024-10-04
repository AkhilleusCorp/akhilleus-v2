<?php

namespace App\Infrastructure\DataTransformer;

use \LogicException;

final class DurationDataTransformer
{
    private const SECONDS_IN_A_DAY = 86400;

    public static function toHMFormat(?int $durationInSecond): ?string
    {
        if (null === $durationInSecond) {
            return null;
        }

        if ($durationInSecond >= self::SECONDS_IN_A_DAY) {
            throw new LogicException('Duration is bigger than a day');
        }

        $hours = (int) ($durationInSecond / 60);
        $minutes = $hours % 60;
        $hours = (int) floor($hours / 60);

        $hoursAsString = '';
        if ($hours === 1) {
            $hoursAsString = "$hours hour";
        } elseif ($hours > 1) {
            $hoursAsString = "$hours hours";
        }

        $minutesAsString = '';
        if ($minutes === 1) {
            $minutesAsString = "$minutes minute";
        } elseif ($minutes > 1) {
            $minutesAsString = "$minutes minutes";
        }

        if ($hours > 0 && $minutes > 0) {
            $minutesAsString = " and $minutesAsString";
        }

        return $hoursAsString . $minutesAsString;
    }
}