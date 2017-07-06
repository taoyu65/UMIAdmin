<?php

namespace YM\Umi\Admin;

use Illuminate\Support\Facades\Config;
use YM\Umi\Contracts\Admin\AdminInterface;

abstract class AdminAbstract implements AdminInterface
{
    protected $hasSuperPermission = false;

    protected $browserPermission = false;
    protected $readPermission = false;
    protected $editPermission = false;
    protected $addPermission = false;
    protected $deletePermission = false;

    public function hasSuperPermission()
    {
        return $this->hasSuperPermission;
    }

    public function browserPermission()
    {
        return $this->browserPermission;
    }

    public function readPermission()
    {
        return $this->readPermission;
    }

    public function editPermission()
    {
        return $this->editPermission;
    }

    public function addPermission()
    {
        return $this->addPermission;
    }

    public function deletePermission()
    {
        return $this->deletePermission;
    }

    public function generateBrowserTable($tableName)
    {
        #检查是否为 不可编辑的数据表
        #check if a data table without editable
        if (in_array($tableName, Config::get('umi.bread_except')))
            throw new \Exception('this table has been locked, please contact supervisor');
    }
}