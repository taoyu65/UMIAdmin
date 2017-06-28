<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Models\Permission;
use YM\Models\PermissionRole;
use YM\Models\Role;
use YM\Models\Table;
use YM\Models\User;
use YM\Models\UserRole;

class authorityController extends Controller
{
    #分配用户权限向导
    #wizard of distribute permission for user
    public function wizard()
    {
        $users = $this->getUsers();
        $userTableName = Config::get('umiEnum.system_table_name.umi_users');
        $roleTableName = Config::get('umiEnum.system_table_name.umi_roles');

        #所有table
        #all tables
        $tableModel = new Table();
        $tables = $tableModel->getAllTable();

        #获取所有权限
        #get all permission
        $permissionModel = new Permission();
        $permission = $permissionModel->allPermission();

        $list = compact('users', 'userTableName', 'roleTableName', 'tables', 'permission');
        return view('umi::authority.wizard', $list);
    }

    public function ajaxRoles()
    {
        $role = new Role();
        return $role->roleNameList();
    }

    public function ajaxUsers()
    {
        return $this->getUsers()->toJson();
    }

    public function wizardUpdate(Request $request) {
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');
        $oldPermissions = json_decode($request->input('oldPermissions'));
        $newPermissions = json_decode($request->input('newPermissions'));

        #检查用户指定的角色是否存在, 不存在则添加
        #check if user has that role, if not then create it
        $userRoleModel = new UserRole();
        if ($userRoleModel->updateUserRole($userId, $roleId)) {
            //ok //todo -
        } else {
            //role had been distributed
        }

        #重新计算并更新角色所属权限
        #recalculate and update the role's permissions
        $permissionRoleModel = new PermissionRole();
        $permissionModel = new Permission();

        #找出修改前后权限的差集, 分别为需要增加的差集和删除的差集
        #find the difference of permission between before and after changes, both different for adding and deleting
        $permission = $permissionModel->allPermissionRegulated();

        $permissionAdd = array_diff($newPermissions, $oldPermissions);
        $permissionAddIds = $this->getPermissionAddIds($permission, $permissionAdd);

        $permissionDelete = array_diff($oldPermissions, $newPermissions);
        $permissionDeleteIds = $this->getPermissionDeleteIds($permission, $permissionDelete);

        if ($permissionRoleModel->updatePermissionRole($roleId, $permissionAddIds, $permissionDeleteIds)) {
            //todo -
        } else {

        }
    }

    private function getPermissionAddIds($permission, $permissionAdd)
    {
        $re = [];
        foreach ($permissionAdd as $item) {
            array_push($re, $permission[$item]);
        }
        return $re;
    }

    private function getPermissionDeleteIds($permission, $permissionDelete)
    {
        $re = [];
        foreach ($permissionDelete as $item) {
            array_push($re, $permission[$item]);
        }
        return $re;
    }

    private function getUsers()
    {
        $user = new User();
        return $user->userNameList();
    }
}