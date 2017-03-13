<?php

namespace YM\umiAuth\src\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    private $userPermsTable;

    public function __construct($user)
    {
        $this->userPermsTable = $this->permission($user->id);
    }

    private function permission($user_id)
    {
        return $this->permissionTable($user_id)->groupBy('umi_permissions.key', 'umi_permissions.table_id');
    }

    private function permissionTable($user_id)
    {
        $minutes = Config::get('umiAuth.cache_minutes');
        return Cache::remember('userPerms', $minutes, function () use ($user_id){
            return DB::table('umi_users')
                ->join('umi_user_role', 'umi_users.id', 'umi_user_role.user_id')
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
                ->where('umi_users.id', $user_id)
                ->get();
        });
    }

    public function getUserPermsTable()
    {
        return $this->userPermsTable;
    }
}