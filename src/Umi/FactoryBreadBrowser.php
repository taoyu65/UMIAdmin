<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Config;
use YM\Umi\DataTable\AdminDataTable;
use YM\Umi\DataTable\AdminDataTableWithSearch;
use YM\Umi\DataTable\customTestAdmin;
use YM\Umi\DataTable\SuperAdminDataTable;
use YM\Umi\DataTable\SuperAdminDataTableWithSearch;
use YM\Facades\Umi as Ym;

class FactoryBreadBrowser
{
    public function __construct($tableName = '')
    {
        #检查是否为 不可编辑的数据表
        #check if a data table without editable
        if (in_array($tableName, Config::get('umi.bread_except')))
            throw new \Exception('this table has been locked, please contact supervisor');
    }

    public function getBreadBrowser()
    {
        $userName = Ym::userName();
        switch ($userName) {
            case Config::get('umi.super_admin'):
                return Config::get('umi.dataTableSearch') ?
                    new SuperAdminDataTableWithSearch() :
                    new SuperAdminDataTable();
            default:
                return Config::get('umi.dataTableSearch') ?
                    new customTestAdmin() :
                    new AdminDataTable();
        }
    }
}