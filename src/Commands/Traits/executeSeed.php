<?php

namespace YM\Commands\Traits;

trait executeSeed
{
    public function executeSeed($class)
    {
        if (!class_exists($class)) {
            require_once $this->seederPath . $class . '.php';
        }
        with(new $class())->run();
    }
}
