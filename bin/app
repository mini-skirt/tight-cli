#!/usr/bin/env php
<?php
namespace MiniSkirt\TightCli;

define('MiniSkirt\TightCli\START_TIME', time());
define('MiniSkirt\TightCli\PROJECT_PATH', dirname(__DIR__));

const CONFIG_PATH = PROJECT_PATH . '/config';

require PROJECT_PATH.'/vendor/autoload.php';

return (new \App\Application)->bootstrap()->run($argv);