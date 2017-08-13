<?php

namespace YM\Models;

class viewRolePermission extends UmiBase
{
    protected $table = 'view_role_permission';
    public $timestamps = true;

    protected $openCache = true;
    protected $cacheAllRecord = true;

    #和方法allPermission基本相同, 不同方法实现而已
    #same function with allPermission, just different method to implement
    public function allPermissions($roleId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('role_id', $roleId)
                ->pluck('permission');

        return self::select('permission')
            ->where('role_id', $roleId)
            ->get()
            ->pluck('permission');
    }

    public function allPermissionRegulated($roleId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('role_id', $roleId)
                ->pluck('id', 'permission')
                ->toArray();

        return self::where('role_id', $roleId)
            ->get()
            ->pluck('id', 'permission')
            ->toArray();
    }
}