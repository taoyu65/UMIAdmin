<?php

namespace YM\Umi\DataTable;

use YM\Umi\FactoryUI;

class AdminDataTable extends umiDataTableAbstract
{
    private $umiDataTable;

    public function __construct()
    {
        $factoryUI = new FactoryUI();
        $this->umiDataTable = $factoryUI->dataTableUI();
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