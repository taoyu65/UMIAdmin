<?php

namespace YM\Umi\DataTable;

use YM\Umi\umiDataTableBuilder;

class SuperAdminDataTable extends umiDataTableAbstract
{
    private $umiDataTable;

    public function __construct()
    {
        $this->umiDataTable = new umiDataTableBuilder();
    }

    public function headerAlert()
    {
        return $this->umiDataTable->tableHeadAlert();
    }

    public function header()
    {
        return $this->headerAlert() .
        $this->umiDataTable->tableHead();
    }

    public function tableBody()
    {
        return $this->umiDataTable->tableBody();
    }

    public function footer()
    {
        return $this->umiDataTable->tableFoot();
    }
}