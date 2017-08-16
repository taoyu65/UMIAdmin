<?php

namespace YM\Umi\Auth;

class AdminMasterPage extends UmiMasterPageAbstract
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sideMenu()
    {
        return $this->masterPageMenuBuilder->Menus();
    }
}