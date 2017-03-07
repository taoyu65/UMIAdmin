<?php

namespace YM\Umi\Auth;

use YM\Umi\MenusBuilder;

class SuperAdminMasterPage extends UmiMasterPage
{
    private $menus;

    public function __construct()
    {
        $this->menus = new MenusBuilder();
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