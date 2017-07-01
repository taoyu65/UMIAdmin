<?php

namespace YM\Umi\Contracts\Admin;

interface AdminInterface
{
    #是否拥有全部权限
    #is has all permission
    public function hasSuperPermission();

    #生成table的界面
    #create browser table
    public function generateBrowserTable($tableName);
}