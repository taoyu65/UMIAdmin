<?php

namespace YM\Umi\Admin;

use Illuminate\Support\Facades\Config;
use YM\Umi\DataTable\SuperAdminDataTable;
use YM\Umi\DataTable\SuperAdminDataTableWithSearch;

class SuperAdmin extends AdminAbstract
{
    protected $hasSuperPermission = true;

    public function generateBrowserTable($tableName)
    {
        parent::generateBrowserTable($tableName);

        return Config::get('umi.dataTableSearch') ?
            new SuperAdminDataTableWithSearch() :
            new SuperAdminDataTable();
    }
}