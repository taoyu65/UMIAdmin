<?php

namespace YM\umiAuth\Traits;

trait umiAuthPermissionTrait
{
    private $DELIMITER_AT = '-';        //between table and action

    /**
     * @param $action - BREAD i.e: browser, read, edit, add, delete
     * @param $table - table's name(string) or table's id(integer)
     * @return bool
     */
    public function hasPermission_at($action, $table)
    {
        #通配符 wildcard
        if ($action === '*') {
            return count($this->getPermissions($table)) > 0 ? true : false;
        }

        return $this->getPermissions($table)
            ->pluck('key')
            ->contains($action);
    }

    /**
     * @param $permissions - "action-table" i.e: "edit-users" or array form i.e: ['edit-users','add-users']
     * @param $requireAll
     * @return bool
     * @throws \Exception - wrong parameter
     */
    public function hasPermission($permissions, $requireAll = false)
    {
        if (is_array($permissions)) {
            if ($requireAll) {
                foreach ($permissions as $permission) {
                    if (!$this->hasPermissionCheck($permission)) return false;
                }
                return true;
            } else {
                foreach ($permissions as $permission) {
                    if ($this->hasPermissionCheck($permission)) return true;
                }
                return false;
            }
        } else {
            return $this->hasPermissionCheck($permissions);
        }
    }

    private function hasPermissionCheck($permission)
    {
        $perms = explode($this->DELIMITER_AT, $permission);
        if (count($perms) != 2)
            throw new \Exception('wrong parameter. the permission should be "action-table"');

        $action = $perms[0];
        $table = $perms[1];
        return $this->hasPermission_at($action, $table);
    }

    public function getPermissions($table)
    {
        $tableType = '';

        if(is_string($table)) $tableType = 'table_name';

        if(is_integer($table)) $tableType = 'table_id';

        return $this->User->permissions()
            ->where($tableType, $table);
    }

    public function can($permissions, $requireAll = false)
    {
        return $this->hasPermission($permissions, $requireAll);
    }

    public function cannot($permissions, $requireAll = false)
    {
        if (is_array($permissions)) {
            if ($requireAll) {
                foreach ($permissions as $permission) {
                    if ($this->hasPermissionCheck($permission)) return false;
                }
                return true;
            } else {
                foreach ($permissions as $permission) {
                    if (!$this->hasPermissionCheck($permission)) return true;
                }
                return false;
            }
        } else {
            return !$this->hasPermissionCheck($permissions);
        }
    }

    public function cant($permissions, $requireAll = false)
    {
        return $this->cannot($permissions, $requireAll = false);
    }
}