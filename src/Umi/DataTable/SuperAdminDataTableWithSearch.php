<?php

namespace YM\Umi\DataTable;

use YM\Umi\FactoryUI;

class SuperAdminDataTableWithSearch extends umiDataTableAbstract
{
    private $umiDataTable;
    private $factoryUI;

    public function __construct()
    {
        $this->factoryUI = new FactoryUI();
        $this->umiDataTable = $this->factoryUI->dataTableUI();
    }

    public function search()
    {
        $search = $this->factoryUI->searchUI();
        return $search->searchHtml();
    }

    public function headerAlert()
    {
        return $this->umiDataTable->tableHeadAlert();
    }

    public function header()
    {
        return $this->search() .
        $this->headerAlert() .
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