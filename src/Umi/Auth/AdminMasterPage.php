<?php

namespace YM\Umi\Auth;

use YM\Umi\administrator;
use YM\Umi\Menus;

class AdminMasterPage extends UmiMasterPage
{
    private $menus;
    private $administrator;

    public function __construct()
    {
        $this->menus = new Menus();
        $this->administrator = new administrator();
    }

    public function header()
    {
        return parent::header();
    }

    public function sideMenu()
    {
        $json = $this->administrator->menusJson();
        return $this->menus->Menus($json);
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