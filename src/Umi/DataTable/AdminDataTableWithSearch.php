<?php

namespace YM\Umi\DataTable;

use YM\Umi\umiDataTableBuilder;

class AdminDataTableWithSearch extends umiDataTableAbstract
{
    protected $head;
    protected $foot;

    private $umiDataTable;

    public function __construct()
    {
        $this->umiDataTable = new umiDataTableBuilder();

        $this->head = $this->umiDataTable->tableHeadAlert();
        $this->foot = $this->umiDataTable->tableFoot();
    }

    public function headerAlert()
    {
        return $this->head;
    }

    public function header()
    {
         return $this->umiDataTable->tableSearch() .
         $this->headerAlert() .
         $this->umiDataTable->tableHead();
    }

    public function tableBody()
    {
        return $this->umiDataTable->tableBody();
    }

    public function footer()
    {
        return $this->foot;
    }
}