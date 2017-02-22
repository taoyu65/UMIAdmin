<?php

namespace YM\Umi\Auth;

class SuperAdminMasterPage extends UmiMasterPage
{

    public function header()
    {
        return parent::header();
    }

    public function sideMenu()
    {
        return parent::AllMenus();
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