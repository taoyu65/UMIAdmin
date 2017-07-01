<?php

namespace YM\Umi\Admin;

use Illuminate\Support\Facades\Config;
use YM\Umi\DataTable\AdminDataTable;
use YM\Umi\DataTable\customTestAdmin;

class GeneralAdmin extends AdminAbstract
{
    protected $hasSuperPermission = false;

    public function generateBrowserTable($tableName)
    {
        parent::generateBrowserTable($tableName);

        return Config::get('umi.dataTableSearch') ?
            new customTestAdmin() :
            new AdminDataTable();
    }
}