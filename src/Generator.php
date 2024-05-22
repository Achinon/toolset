<?php

namespace Achinon\ToolSet;

class Generator
{
    private const NUMBERS = '0987654321';
    private const CHARS = 'abcdefghijklmnopqrstuvwxyz';

    public static function randomNumericString(int $length = 6): string
    {
        return static::randomizer(static::NUMBERS, $length);
    }

    public static function randomAlphanumericString(int $length = 10, bool $hex = false): string
    {
        $letters = static::CHARS . strtoupper(static::CHARS);
        $lettersHex = substr($letters, 0, 6);

        $string = $hex ? static::NUMBERS . $lettersHex : static::NUMBERS . $letters;
        return static::randomizer($string, $length);
    }

    private static function randomizer(string $string, int $length): string
    {
        $charactersLength = strlen($string);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $string[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function friendlyString(int $length = 5, string $divider = "_", bool $hexadecimal = false): string
    {
        return self::randomAlphanumericString($length, $hexadecimal) . $divider .
          self::randomAlphanumericString(floor($length / 3), $hexadecimal) . $divider .
          self::randomAlphanumericString(ceil($length / 2), $hexadecimal);
    }
}
