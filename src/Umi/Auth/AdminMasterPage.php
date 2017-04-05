<?php

namespace YM\Umi\Auth;

use YM\Umi\umiMenusBuilder;

class AdminMasterPage extends UmiMasterPage
{
    private $menusBuilder;

    public function __construct()
    {
        parent::__construct();

        $this->menusBuilder = new umiMenusBuilder();
    }

    public function sideMenu()
    {
        return $this->menusBuilder->Menus();
    }
}