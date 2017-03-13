<?php

namespace YM\umiAuth;

use YM\umiAuth\src\contracts\umiAuthInterface;
use YM\umiAuth\src\models\User;

class umiAuth implements umiAuthInterface
{
    private $User;
    private $userInfo;
    private $DELIMITER_AT = '-';        //between table and action
    private $DELIMITER_PERM = '|';      //between permissions

    public function __construct($user = null)
    {
        $this->userInfo = $user;
        $this->User = new User($user);
    }

    public function can()
    {

    }

    /**
     * @param $action - BREAD i.e: browser, read, edit, add, delete
     * @param $table - table name
     * @return bool
     */
    public function hasPermission_at($action, $table)
    {
        $tableType = '';

        if(is_string($table)) $tableType = 'table_name';

        if(is_integer($table)) $tableType = 'table_id';

        return $this->User->getUserPermsTable()
            ->flatten()
            ->where($tableType, $table)->pluck('key')->contains($action);
    }

    /**
     * @param $permissions - "action-table" i.e: "edit-users"
     * @return mixed
     * @throws \Exception - wrong parameter
     */
    public function hasPermission($permissions)
    {
        $perms = explode($this->DELIMITER_AT, $permissions);
        if (count($perms) != 2)
            throw new \Exception('wrong parameter. the permission should be "action-table"');

        $action = $perms[0];
        $table = $perms[1];
        return $this->hasPermission_at($action, $table);
    }
}