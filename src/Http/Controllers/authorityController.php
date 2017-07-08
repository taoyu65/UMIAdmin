<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\Permission;
use YM\Models\PermissionRole;
use YM\Models\Role;
use YM\Models\Table;
use YM\Models\User;

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

        $systemRole = array_values(Config::get('umi.system_role'));

        $list = compact('users', 'userTableName', 'roleTableName', 'tables', 'permission', 'systemRole');
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

    #重新计算并更新用户所属角色,以及角色所属权限
    #recalculate and update the users role, and role's permissions
    public function wizardUpdate(Request $request) {
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');
        $oldPermissions = $request->input('oldPermissions') ? json_decode($request->input('oldPermissions')) : [];
        $newPermissions = $request->input('newPermissions') ? json_decode($request->input('newPermissions')) : [];

        #检查用户指定的角色是否存在, 不存在则添加
        #check if user has that role, if not then create it
        //由于使用事务,具体操作移动到方法updatePermissionRole() 中
        //because of using transaction, the operation moved to updatePermissionRole().

        #找出修改前后权限的差集, 分别为需要增加的差集和删除的差集
        #find the difference of permissionRegulated between before and after changes, both different for adding and deleting
        $permissionModel = new Permission();
        $permissionRegulated = $permissionModel->allPermissionRegulated();

        $permissionAdd = array_diff($newPermissions, $oldPermissions);
        $permissionAddIds = $this->getPermissionAddIds($permissionRegulated, $permissionAdd);

        $permissionDelete = array_diff($oldPermissions, $newPermissions);
        $permissionDeleteIds = $this->getPermissionDeleteIds($permissionRegulated, $permissionDelete);

        $permissionRoleModel = new PermissionRole();
        $permissionRoleModel->updatePermissionRole($userId, $roleId, $permissionAddIds, $permissionDeleteIds);

        Umi::showMessage('update success!');

        #因为重用这个控制器, 根据是否存在用户ID 返回不同的页面
        #because reuse this controller, will be returning different blade according to if the user Id is null or not
        return $userId ?
            redirect()->route('wizard') :
            redirect()->route('rolePermission');
    }

    public function rolePermission()
    {
        #所有table
        #all tables
        $tableModel = new Table();
        $tables = $tableModel->getAllTable();

        #获取所有权限
        #get all permission
        $permissionModel = new Permission();
        $permission = $permissionModel->allPermission();

        #获取所有角色
        #ge all the role
        $roles = $this->ajaxRoles();
        $roles = json_decode($roles);

        $list = compact('tables', 'permission', 'roles');
        return view('umi::authority.rolePermission', $list);
    }

#region Private method
    #比较权限 获取需要增加权限的ID
    #compare permissions, and get all the permission's id which need to be added
    private function getPermissionAddIds($permission, $permissionAdd)
    {
        $re = [];
        foreach ($permissionAdd as $item) {
            array_push($re, $permission[$item]);
        }
        return $re;
    }

    #比较权限 获取需要删除权限的ID
    #compare permissions, and get all the permission's id which need to be deleted
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
#endregion
}