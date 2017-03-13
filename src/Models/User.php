<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'umi_users';

    private $modelNameSpace = 'YM\Models';

    public function MenuJson()
    {
        return $this->hasOne($this->modelNameSpace . '\RoleMenu', 'role_id');
    }

    public function roles()
    {
        return $this->belongsToMany($this->modelNameSpace . '\Role', 'umi_user_role', 'user_id','role_id');
    }
}