<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Models\Role;
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

        $list = compact('users', 'userTableName', 'roleTableName');
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

    private function getUsers()
    {
        $user = new User();
        return $user->userNameList();
    }
}