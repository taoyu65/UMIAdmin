<?php

namespace YM\Umi\Auth;

use YM\Umi\Contracts\PrintHtml\MasterPageInterface;
use YM\Umi\FactoryUI;

abstract class UmiMasterPageAbstract implements MasterPageInterface
{
    protected $masterPageBuilder;
    protected $masterPageMenuBuilder;

    public function __construct()
    {
        $factoryUI = new FactoryUI();
        $this->masterPageBuilder = $factoryUI->masterPageUI();
        $this->masterPageMenuBuilder = $factoryUI->masterPageMenuUI();
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