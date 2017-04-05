<?php

namespace YM\umiAuth\Facades;

use Illuminate\Support\Facades\Facade;

class umiAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'umiAuth';
    }
}