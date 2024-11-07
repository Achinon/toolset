<?php

namespace Achinon\ToolSet;

use Exception;

class Dumper
{
    /**
     * @param mixed ...$params
     *
     * @return void
     */
    public static function json(...$params): void
    {
        echo '<pre>';
        foreach ($params as $param){
            json_encode($param, JSON_PRETTY_PRINT);
        }
        echo '</pre>';
        exit();
    }

    /**
     * @param mixed ...$params
     *
     * @return void
     */
    public static function print(...$params): void
    {
        echo '<pre>';
        foreach ($params as $param){
            print_r($param);
        }
        echo '</pre>';
        exit();
    }

    /**
     * @param mixed ...$params
     *
     * @return void
     */
    public static function echo(...$params): void
    {
        echo '<pre>';
        foreach ($params as $k => $v) {
            echo "$k: ";
        }
        echo '</pre>';
        exit();
    }

    /**
     * @param mixed ...$params
     *
     * @return void
     */
    public static function generic(...$params): void
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);

        $callerInfo = $backtrace[0];
        $callerLine = $callerInfo['line'];

        $callerClass = $backtrace[1]['class'] ?? null;
        $callerFunction = $backtrace[1]['function'] ?? null;

        if ($callerClass) {
            $callerInfo = "$callerClass::$callerFunction($callerLine)";
        } else {
            $callerInfo = "global_scope:$callerLine";
        }

        echo "Dump called at: $callerInfo" . PHP_EOL;
        foreach ($params as $param) {
            var_dump($param);
        }
        exit();
    }
}