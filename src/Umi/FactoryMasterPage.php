<?php

namespace YM\Umi;

use YM\Umi\Auth\AdminMasterPage;
use YM\Umi\Auth\SuperAdminMasterPage;

class FactoryMasterPage
{
    private $administrator;

    public function __construct()
    {
        $this->administrator = new administrator();
    }

    public function getMasterPage()
    {
        if ($this->administrator->__get('isSuperAdmin')) {
            return new SuperAdminMasterPage();
        } else {
            return new AdminMasterPage();
        }
    }
}