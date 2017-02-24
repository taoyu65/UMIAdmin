<?php

namespace YM\Umi\Auth;

use YM\Umi\Menus;

class SuperAdminMasterPage extends UmiMasterPage
{
    private $menus;

    public function __construct()
    {
        $this->menus = new Menus();
    }

    public function header()
    {
        return parent::header();
    }

    public function sideMenu()
    {
        return $this->menus->AllMenus();
    }

    public function body()
    {
        return parent::body();
    }

    public function footer()
    {
        return parent::footer();
    }
}