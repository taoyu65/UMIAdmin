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

    public function __construct()
    {

    }

    public function isSuperAdmin()
    {
        if (Config::get('umi.url_auth')) {
            $this->isSuperAdmin = Auth::user()->name === Config::get('umi.super_admin') ? true : false;
        } else {
            $this->isSuperAdmin = true;
        }
        return $this->isSuperAdmin;
    }

    public function menusJson()
    {
        $minute = Config::get('umi.cache_minutes');
        $json = Cache::remember('menuJson', $minute, function () {
            $user = User::find(Auth::user()->id);
            return $user->MenuJson()->firstOrFail()->json;
        });
        return $json;
    }
}