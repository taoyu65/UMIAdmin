<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'umi_user_role';

    public function updatePermissionRole($roleId, $permissionAddIds, $permissionDeleteIds)
    {
        //todo - get all ids already, delete and add those ids, make sure use transaction
        dd($permissionDeleteIds);
    }
}