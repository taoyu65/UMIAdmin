<?php

namespace YM\Umi\Contracts\Admin;

interface AdminInterface
{
    #是否拥有全部权限
    #is has all permission
    public function hasSuperPermission();

    #在没有全部权限的情况下, 分别是否可以拥有增删查改的权限(BREAD)
    #when user doesn't have super permission, to see if there is a specific permission (BREAD)
    public function browserPermission();

    public function readPermission();

    public function editPermission();

    public function addPermission();

    public function deletePermission();

    #生成table的界面
    #create browser table
    public function generateBrowserTable($tableName);

}