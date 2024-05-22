<?php

namespace Achinon;

class ClassInspector
{
    /**
     * @param $class_instance
     * @param class-string $fqcn
     *
     * @return bool
     */
    public static function isInstanceOfClass($class_instance, string $fqcn): bool
    {
        return get_class($class_instance) === $fqcn;
    }

    public static function getParentClassName(int $offset = 0): string
    {
        $trace = debug_backtrace();

        $class = $trace[1 + $offset]['class'];

        for ($i = 1; $i < count($trace); $i++) {
            if (isset($trace[$i]) && $class != $trace[$i]['class']) {
                return $trace[$i]['class'];
            }
        }

        return '';
    }

    public static function getCallingClassName(int $offset = 0): string
    {
        $trace = debug_backtrace();

        return $trace[1 + $offset]['class'];
    }

    public static function getParentObject(int $offset = 0)
    {
        $trace = debug_backtrace();

        $class = $trace[1 + $offset]['object'];

        for ($i = 1; $i < count($trace); $i++) {
            if (isset($trace[$i]) && $class != $trace[$i]['object']) {
                return $trace[$i]['object'];
            }
        }

        return null;
    }

    /**
     * Restrict the method to be called only by a specific class.
     *
     * @param string $classToRestrictTo
     * @throws \Exception
     */
    public static function restrictToSpecificClassOnly(string $classToRestrictTo = self::class): void
    {
        $callingClass = static::getCallingClassName(2);

        if ($callingClass !== $classToRestrictTo) {
            throw new \Exception("Method can only be called by $classToRestrictTo class.");
        }
    }
}
