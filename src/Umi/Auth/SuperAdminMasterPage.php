<?php

namespace YM\Umi\Auth;

class SuperAdminMasterPage extends UmiMasterPageAbstract
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sideMenu()
    {
        return $this->masterPageMenuBuilder->AllMenus();
    }
}