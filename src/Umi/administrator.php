<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use YM\Models\User;

/**
 * register as a singleton, the class keep all the status of user
 * 注册为单例, 这个类记录管理员的状态
 */
class administrator
{
    private $isSuperAdmin = false;
    private $minute;
    private $userName;

    private static $currentControlledTable;

    public function __construct()
    {
        $this->minute = Config::get('umi.cache_minutes');
        $this->userName = Auth::user()->name;
    }

    public function isSuperAdmin()
    {
        if (Config::get('umi.url_auth')) {
            $this->isSuperAdmin = $this->userName === Config::get('umi.super_admin') ? true : false;
        } else {
            $this->isSuperAdmin = true;
        }
        return $this->isSuperAdmin;
    }

    public function menusJson()
    {
        $json = Cache::remember('menuJson', $this->minute, function () {
            $user = User::find(Auth::user()->id);
            return $user->MenuJson()->firstOrFail()->json;
        });
        return $json;
    }

    public static function setCurrentTable($tableName)
    {
        static::$currentControlledTable = $tableName;
    }
    public static function currentTableName()
    {
        return static::$currentControlledTable;
    }
}