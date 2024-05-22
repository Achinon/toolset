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
        
        // Get the caller's file and line
        $b = $backtrace[0];
        $callerLine = $backtrace[1]['class'] . ":" .$backtrace[0]['line'];
        
        echo "Dump called at: " . $callerLine . PHP_EOL;
        foreach ($params as $param){
            var_dump($param);
        }
        exit();
    }
}