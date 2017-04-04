<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class User extends Model
{
    protected $table = 'umi_users';

    private $modelNameSpace = 'YM\Models';

    public function MenuJson()
    {
        return $this->hasOne($this->modelNameSpace . '\RoleMenu', 'role_id');
    }

    public function menusJson()
    {
        $minute = Config::get('umi.cache_minutes');
        $json = Cache::remember('menuJson', $minute, function () {

            return self::find(Auth::user()->id)
                ->MenuJson()
                ->firstOrFail()
                ->json;
        });
        return $json;
    }
}