<?php

namespace YM\Umi\DataTable;

use YM\Umi\Contracts\PrintHtml\umiDataTableInterface;

abstract class umiDataTableAbstract implements umiDataTableInterface
{
    public function header()
    {
        $html = <<<EOD
        search area showing.
EOD;
        return $html;
    }

    public function tableBody()
    {
        $html = <<<EOD

EOD;
        return $html;
    }

    public function footer()
    {
        $html = <<<EOD
        page footer
EOD;
        return $html;
    }
}