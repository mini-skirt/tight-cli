<?php
namespace MiniSkirt\TightCli;

class Application
{
    const VERSION = '1.0.0';
    const MSG_COMMAND_NOT_FOUND = 'Command not found.';

    public function run($argv)
    {
        $r = $this->resolveArgs($argv);
        return $this->execute(
            $this->resolveCommand(
                $r[0] ?? null
            ),
            $r[1] ?? []
        );
    }

    public function resolveArgs($arguments = [])
    {
        if (empty($arguments) or count($arguments) <= 1) return $this->resolveNullArgs();
        array_shift($arguments);
        $command = $arguments[0];
        array_shift($arguments);


        return [$command, $arguments];
    }

    public function resolveNullArgs()
    {
        return [];
    }

    public function resolveCommand($command)
    {
        if (is_null($command)) return $this->resolveNullCommand();

        $bind = State::bind();
        if (isset($bind->$command)) return $bind->$command;

        $fn = '\\App\LooseFunction\\'.$command;
        if (function_exists($fn)) return $fn; 

        return $this->resolveMissCommand();
    }

    public function resolveNullCommand()
    {
        return null;
    }
    public function resolveMissCommand()
    {
        return null;
    }

    public function execute($callable, $args = [])
    {
        if (! is_callable($callable)) {
            IO::writeLine(static::MSG_COMMAND_NOT_FOUND);
            return 1;
        }

        return $callable(...$args);
    }

    public function bootstrap()
    {
        State::import(new StatePackage);
        return $this;
    }
}