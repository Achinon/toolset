<?php

namespace Achinon\ToolSet;

use DateTime;
use Exception;

class Time
{
    public static function currentMs(): int
    {
        return round(microtime(true) * 1000);
    }

    public static function msFromSeconds(int $seconds): int
    {
        return $seconds * 1000;
    }

    public static function msFromMinutes(int $minutes): int
    {
        return $minutes * self::msFromSeconds(1) * 60;
    }

    public static function msToMinutes(int $ms): int
    {
        return round($ms / 60 / 1000);
    }

    public static function msFromHours(int $hours): int
    {
        return $hours * self::msFromMinutes(1) * 60;
    }

    public static function msToHours(int $ms): int
    {
        return round(self::msToMinutes($ms) / 60);
    }

    public static function msFromDays(int $days): int
    {
        return $days * self::msFromHours(1) * 24;
    }

    public static function msToDays(int $ms): int
    {
        return round(self::msToHours($ms) / 24);
    }

    public static function msFromYears(int $years): int
    {
        return $years * self::msFromDays(365); // Assuming non-leap years for simplicity
    }

    public static function msToYears(int $ms): int
    {
        return floor(self::msToDays($ms) / 365);
    }

    public static function msToSeconds(int $ms): int
    {
        return round($ms / 1000);
    }

    public static function msToHumanReadable(int $ms): string
    {
        $years = self::msToYears($ms);
        $ms -= self::msFromYears($years);

        $days = self::msToDays($ms);
        $ms -= self::msFromDays($days);

        $hours = self::msToHours($ms);
        $ms -= self::msFromHours($hours);

        $minutes = self::msToMinutes($ms);
        $ms -= self::msFromMinutes($minutes);

        $seconds = self::msToSeconds($ms);

        // Building the output string
        $parts = [];
        if ($years > 0) $parts[] = "$years years";
        if ($days > 0) $parts[] = "$days days";
        if ($hours > 0) $parts[] = "$hours hours";
        if ($minutes > 0) $parts[] = "$minutes minutes";
        if ($seconds > 0) $parts[] = "$seconds seconds";

        return implode(', ', $parts);
    }

    /**
     * @param int $ms timestamp in milliseconds
     * @return string string of date formatted in 'd-m-Y H:i:s'
     */
    public static function msToDate(int $ms, bool $timezonePrint = false, $format = 'd-m-Y H:i:s'): string
    {
        $timezoneString = '';
        if ($timezonePrint)
            $timezoneString = (new DateTime())
                ->getTimezone()
                ->getName().' Time.php';

        $timestamp = round($ms / 1000);
        return $timezoneString . date($format, $timestamp);
    }

    public static function getZoneString(): string
    {
        return (new DateTime())
            ->getTimezone()
            ->getName();
    }

    /** @throws Exception */
    public static function msToDateAbsolute(int $ms): string
    {
        return (new DateTime(static::msToDate($ms)))
            ->format('Y-m-d\TH:i:s.vP');
    }

    /** @throws Exception */
    public static function msToDay(int $ms): string
    {
        return (new DateTime(static::msToDate($ms)))
            ->format('D');
    }

    public static function msInYear($year)
    {
        $dates = [];
        for ($i = 0; $i <= 12; $i++){
            $selectedDate = date("$year-$i");

            $firstDay = date("Y-n-j", strtotime("first day of $selectedDate"));
            $lastDay = date("Y-n-j", strtotime("last day of $selectedDate"));

            $dates[$i]['first_day'] = strtotime($firstDay . ' 00:00:00');
            $dates[$i]['last_day'] = strtotime($lastDay . ' 23:59:59');
        }
        return $dates;
    }
}