<?php

namespace App\Infrastructure\DataTransformer;

use \LogicException;

final class DurationDataTransformer
{
    private const SECONDS_IN_A_DAY = 86400;
    private const SECONDS_IN_A_MINUTE = 60;

    public static function toHMFormat(?int $durationInSecond): ?string
    {
        if (true === empty($durationInSecond)) {
            return null;
        }

        if ($durationInSecond >= self::SECONDS_IN_A_DAY) {
            throw new LogicException('Duration is bigger than a day');
        }

        if ($durationInSecond < self::SECONDS_IN_A_MINUTE) {
            throw new LogicException('Duration is smaller than a minute');
        }

        $hours = (int) ($durationInSecond / 60);
        $minutes = $hours % 60;
        $hours = (int) floor($hours / 60);

        $hoursAsString = $hours > 0 ? "{$hours}h" : "";
        $minutesAsString = $minutes > 0 ? "{$minutes}min" : "";

        if ($hours > 0 && $minutes > 0) {
            return "{$hoursAsString} {$minutesAsString}";
        }

        return $hoursAsString . $minutesAsString;
    }
}