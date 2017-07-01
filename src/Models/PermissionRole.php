<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionRole extends Model
{
    use BreadOperation;

    protected $table = 'umi_permission_role';

    public function updatePermissionRole($userId, $roleId, $permissionAddIds, $permissionDeleteIds)
    {
        $insertArr = [];
        foreach ($permissionAddIds as $permissionAddId) {
            array_push($insertArr, [
                'role_id'       => $roleId,
                'permission_id' => $permissionAddId
            ]);
        }

        DB::transaction(function () use ($userId, $roleId, $insertArr, $permissionDeleteIds) {
            #更新用户角色
            #update user role
            if ($userId) {
                $userRoleModel = new UserRole();
                $userRoleModel->updateUserRole($userId, $roleId);
            }

            #增加新权限
            #add new permissions
            DB::table($this->table)
                ->insert($insertArr);

            #删除权限
            #delete permissions
            DB::table($this->table)
                ->whereIn('permission_id', $permissionDeleteIds)
                ->delete();
        });
    }
}