<?php

namespace YM\Umi\Auth;

use YM\Umi\Contracts\PrintHtml\MasterPageInterface;
use YM\Umi\umiMasterPageBuilder;

abstract class UmiMasterPageAbstract implements MasterPageInterface
{
    private $masterPageBuilder;

    public function __construct()
    {
        $this->masterPageBuilder = new umiMasterPageBuilder();
    }

    public function header()
    {
        return $this->masterPageBuilder->masterPageHead();
    }

    public function sideMenu()
    {
        $html = <<<UMI

UMI;
        return $html;
    }

    public function body()
    {
        return $this->masterPageBuilder->masterPageBody();
    }

    public function footer()
    {
        return $this->masterPageBuilder->masterPageFoot();
    }
}