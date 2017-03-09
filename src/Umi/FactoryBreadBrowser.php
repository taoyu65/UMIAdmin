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

    public function __construct()
    {
        $this->administrator = new administrator();
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