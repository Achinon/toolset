<?php

namespace Achinon;

class PregChecker
{
    public static function base(string $value): ?string
    {
        if (preg_match("/^[a-z,_-]+$/i", $value)) {
            return $value;
        }
        return null;
    }

    public static function no_special(string $value): string
    {
        return preg_replace('/[^\p{L}\p{N}]/u', '', $value);
    }

    public static function email(string $value): ?string
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $value;
        }
        return null;
    }

    public static function url(string $value): ?string
    {
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value)) {
            return $value;
        }
        return null;
    }

    public static function nip(string $value): ?string
    {
        $value = str_replace(["-", " "], "", $value);
        if (preg_match("/^\d{10}$/", $value)) {
            return $value;
        }
        return null;
    }

    public static function phone(string $value): ?string
    {
        $value = str_replace([' ', '+', '-', '(', ')'], '', $value);
        if (preg_match("/^\d{8,16}$/", $value)) {
            return $value;
        }
        return null;
    }

    public static function int(string $value): ?int
    {
        if (preg_match("/^\d+$/", $value)) {
            return (int)$value;
        }
        return null;
    }

    public static function float($value): ?float
    {
        if (is_numeric($value)) {
            return (float)$value;
        }
        return null;
    }

    public static function array(array $array, string $pregFunctionName): array
    {
        if (method_exists(self::class, $pregFunctionName)) {
            foreach ($array as $k => $v) {
                $array[$k] = self::$pregFunctionName($v);
            }
        }
        return $array;
    }

    public static function password(string $password): ?string
    {
        if (strlen($password) >= 9 &&
          preg_match('@[A-Z]@', $password) &&
          preg_match('@[a-z]@', $password) &&
          preg_match('@[0-9]@', $password) &&
          preg_match('@[\W]@', $password)) {
            return $password;
        }
        return null;
    }
}
