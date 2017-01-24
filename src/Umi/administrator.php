<?php

namespace YM\Umi;

use YM\Models\Menu;

/**
 * register as a singleton, the class keep all the status of user
 * 注册为单例, 这个类记录管理员的状态
 */
class administrator
{
    private $menus;
    private $isSuperAdmin = false;

    public function __construct()
    {
        if (config('umi.url_auth')) {

        } else {
            $this->isSuperAdmin = true;
        }
    }

    public static function menus()
    {
        //todo: get menus
    }

    public static function search()
    {
        //todo : get search
    }

    public static function bread()
    {
        //todo: get bread
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        if (isset($this->$name))  {
            return $this->$name;
        } else {
            return (null);
        }
    }
}