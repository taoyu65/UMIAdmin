<?php

namespace YM\Umi\DataTable;

use YM\Umi\umiDataTableBuilder;

class AdminDataTable extends umiDataTableAbstract
{
    private $umiDataTable;

    public function __construct()
    {
        $this->umiDataTable = new umiDataTableBuilder();
    }

    public function header()
    {
        parent::header(); // TODO: Change the autogenerated stub
    }

    public function tableBody()
    {
        parent::tableBody(); // TODO: Change the autogenerated stub
    }

    public function footer()
    {
        return 'fo';
    }
}