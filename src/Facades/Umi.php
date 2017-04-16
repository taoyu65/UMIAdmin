<?php

namespace YM\Facades;

use Illuminate\Support\Facades\Facade;

class Umi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'umi';
    }
}