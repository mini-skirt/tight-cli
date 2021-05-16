<?php
namespace MiniSkirt\TightCli;

class State
{
    protected static $data = null;
    public static function get()
    {
        return static::$data;
    }
    public static function __callStatic($name, $arguments)
    {
        return static::$data?->$name;
    }
    public static function import(object $package)
    {
        static::$data = $package->export();
    }
}