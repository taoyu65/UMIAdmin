<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Config;
use YM\Umi\DataTable\AdminDataTable;
use YM\Umi\DataTable\AdminDataTableWithSearch;
use YM\Umi\DataTable\SuperAdminDataTable;
use YM\Umi\DataTable\SuperAdminDataTableWithSearch;

class FactoryBreadBrowser
{
    private $administrator;

    public function __construct($tableName = '')
    {
        #检查是否为 不可编辑的数据表
        #check if a data table without editable
        if (in_array($tableName, Config::get('umi.bread_except')))
            throw new \Exception('this table has been locked, please contact supervisor');

        $this->administrator = new administrator();
        $this->administrator->setCurrentTable($tableName);
    }

    public function getBreadBrowser()
    {
        if ($this->administrator->isSuperAdmin()) {
            if (Config::get('umi.dataTableSearch')) {
                return new SuperAdminDataTableWithSearch();
            } else {
                return new SuperAdminDataTable();
            }
        } else {
            if (Config::get('umi.dataTableSearch')) {
                return new AdminDataTableWithSearch();
            } else {
                return new AdminDataTable();
            }
        }
    }
}