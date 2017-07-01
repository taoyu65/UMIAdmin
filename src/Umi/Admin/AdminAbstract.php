<?php

namespace YM\Umi\Admin;

use Illuminate\Support\Facades\Config;
use YM\Umi\Contracts\Admin\AdminInterface;

abstract class AdminAbstract implements AdminInterface
{
    protected $hasSuperPermission = false;

    public function hasSuperPermission()
    {
        return $this->hasSuperPermission;
    }

    public function generateBrowserTable($tableName)
    {
        #检查是否为 不可编辑的数据表
        #check if a data table without editable
        if (in_array($tableName, Config::get('umi.bread_except')))
            throw new \Exception('this table has been locked, please contact supervisor');
    }
}