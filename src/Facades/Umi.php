<?php

namespace YM\Umi\Facades;

use Illuminate\Support\Facades\Facade;

class Umi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Umi';
    }
}