<?php

namespace YM\umiAuth;

use YM\umiAuth\src\contracts\umiAuthInterface;
use YM\umiAuth\src\Models\User;
use YM\umiAuth\traits\umiAuthPermissionTrait;
use YM\umiAuth\traits\umiAuthRoleTrait;

class umiAuth implements umiAuthInterface
{
    use umiAuthRoleTrait;
    use umiAuthPermissionTrait;

    private $User;
    private $DELIMITER_AT = '-';        //between table and action
    private $DELIMITER_PERM = '|';      //between permissions

    public function __construct()
    {
        $this->User = new User();
    }
}