<?php

namespace YM\umiAuth\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Model
{
    protected $table = 'users';

    private $userPermsTable;
    private $modelNameSpace = 'YM\umiAuth\src\Models';

    public function __construct()
    {
        $this->userPermsTable = $this->permissionTable(Auth::user()->id);
    }

    #获得并缓存来自内联查询的数据
    #get and cache table that are joined by user, role, permission, table
    private function permissionTable($user_id)
    {
        $minutes = Config::get('umiAuth.cache_minutes');
        $callback = function () use ($user_id) {
            return DB::table('users')
                ->join('umi_user_role', 'users.id', 'umi_user_role.user_id')
                ->join('umi_roles', 'umi_user_role.role_id', 'umi_roles.id')
                ->join('umi_permission_role', 'umi_permission_role.role_id', 'umi_roles.id')
                ->join('umi_permissions', 'umi_permissions.id', 'umi_permission_role.permission_id')
                ->join('umi_tables', 'umi_permissions.table_id', 'umi_tables.id')
                ->select(
                    'umi_permissions.table_id',
                    'umi_permissions.key',
                    'umi_permissions.display_name',
                    'umi_roles.role_name',
                    'umi_roles.display_name',
                    'umi_permission_role.permission_id',
                    'umi_permission_role.role_id',
                    'umi_tables.table_name'
                )
                ->where('users.id', $user_id)
                ->get();
        };
        return Cache::remember('userPerms', $minutes, $callback);
    }

    #region 公用函数,可以被调用的方法 public function which can be invoke
    public function permissions()
    {
        return $this->userPermsTable;
    }

    public function roles()
    {
        return $this->userPermsTable;
    }

    public function tables()
    {
        return $this->userPermsTable;
    }

    public function getRoles()
    {
        return $this->belongsToMany($this->modelNameSpace . '\Role', 'umi_user_role', 'user_id','role_id');
    }
    #endregion
}