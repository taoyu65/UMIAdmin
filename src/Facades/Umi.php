<?php
/**
 * Created by PhpStorm.
 * User: taoyu
 * Date: 1/5/2017
 * Time: 10:30 PM
 */

namespace YM\Umi\Facades;

use Illuminate\Support\Facades\Facade;

class Umi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Umi';
    }
}