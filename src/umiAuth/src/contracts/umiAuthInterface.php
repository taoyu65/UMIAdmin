<?php

namespace YM\umiAuth\src\contracts;

interface umiAuthInterface
{
    public function hasPermission($permissions);

    public function hasRole($roleNamesOrIds);

    public function attach($rolesOrRoleIds);

    public function detach($RoleId);

    public function ability($roles, $permissions);

    public function getPermissions($table);
}