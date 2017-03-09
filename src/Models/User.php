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

    public function permission($user_id)
    {
        return DB::table('umi_users')
            ->join('umi_user_role', 'umi_users.id', 'umi_user_role.user_id')
            ->join('umi_roles', 'umi_user_role.role_id', 'umi_roles.id')
            ->join('umi_permission_role', 'umi_permission_role.role_id', 'umi_roles.id')
            ->join('umi_permissions', 'umi_permissions.id', 'umi_permission_role.permission_id')
            ->select('key', 'table_id')
            ->where('umi_users.id', $user_id)
            ->groupBy('key', 'table_id')
            ->get();
    }
}