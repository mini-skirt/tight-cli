<?php
namespace MiniSkirt\TightCli;

class StatePackage
{
    public function export(): object
    {
        return (object) [
            'env' => (object) [
                'operatingSystem' => (object) [
                    'family' => (PHP_SHLIB_SUFFIX === 'dll') ? 'windows' : 'unix-like'
                ],
                'php' => (object) [
                    'version' => PHP_VERSION
                ] 
            ],
            'framework' => (object) [
                'name' => 'tight-cli',
                'version' => Application::VERSION
            ],
            'app' => (object) [
                'startTime' => START_TIME,
                'version'   => \App\Application::VERSION,
                'path'      => PROJECT_PATH
            ],
            'config' => (object) require(CONFIG_PATH.'/config.php'),
            'secret' => (object) require(CONFIG_PATH.'/config.secret.php'),
            'bind'   => (object) require(PROJECT_PATH.'/app/bind.php')
        ];
    }
}