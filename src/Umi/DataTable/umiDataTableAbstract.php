<?php

namespace YM\Umi\DataTable;

use YM\Umi\Contracts\PrintHtml\umiDataTableInterface;

abstract class umiDataTableAbstract implements umiDataTableInterface
{
    public function header()
    {
        $html = <<<UMI
        search area showing.
UMI;
        return $html;
    }

    public function tableBody()
    {
        $html = <<<UMI

UMI;
        return $html;
    }

    public function footer()
    {
        $html = <<<UMI
        page footer
UMI;
        return $html;
    }
}