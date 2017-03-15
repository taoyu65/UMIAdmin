<?php

namespace YM\umiAuth\Traits;

use Illuminate\Support\Facades\Auth;
use YM\umiAuth\src\Models\Role;
use YM\umiAuth\src\models\User;

trait umiAuthRoleTrait
{
    /**
     * @param $roleNameOrId - role's name(string) or role's id(integer)
     * @return bool
     */
    public function hasRole($roleNameOrId)
    {
        $field = '';

        if(is_string($roleNameOrId)) $field = 'role_name';

        if(is_integer($roleNameOrId)) $field = 'role_id';

        return $this->User->roles()
            ->flatten()
            ->pluck($field)
            ->contains($roleNameOrId);
    }

    public function attach($roleOrRoleId)
    {
        if (!is_integer($roleOrRoleId) && !is_object($roleOrRoleId)) throw new \Exception('parameter might be wrong');
        return User::find(Auth::user()->id)
            ->getRoles()
            ->attach($roleOrRoleId);
    }
}