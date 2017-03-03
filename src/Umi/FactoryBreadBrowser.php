<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Config;
use YM\Umi\DataTable\umiDataTable;
use YM\Umi\DataTable\umiDataTableWithSearch;

class FactoryBreadBrowser
{
    public function getBreadBrowser()
    {
        if (Config::get('dataTableSearch')) {
            return new umiDataTable();
        } else {
            return new umiDataTableWithSearch();
        }
    }
}