<?php

namespace YM\umiAuth\Traits;

use Illuminate\Support\Facades\Auth;
use YM\umiAuth\src\models\User;

trait umiAuthRoleTrait
{
    /**
     * @param $roleNamesOrIds - role's name(string) or role's id(integer)
     * @param bool $requireAll - if check all
     * @return bool
     */
    public function hasRole($roleNamesOrIds, $requireAll = false)
    {
        if (is_array($roleNamesOrIds)) {
            if ($requireAll) {
                foreach ($roleNamesOrIds as $roleNamesOrId) {
                    if (!$this->hasRoleExecute($roleNamesOrId)) return false;
                }
                return true;
            } else {
                foreach ($roleNamesOrIds as $roleNamesOrId) {
                    if ($this->hasRoleExecute($roleNamesOrId)) return true;
                }
                return false;
            }
        } else {
            return $this->hasRoleExecute($roleNamesOrIds);
        }
    }

    /**
     * @param $roleNameOrId - role's name(string) or role's id(integer)
     * @return bool
     */
    public function hasRoleExecute($roleNameOrId)
    {
        $field = '';

        if(is_string($roleNameOrId)) $field = 'role_name';

        if(is_integer($roleNameOrId)) $field = 'role_id';

        return $this->User->roles()
            ->pluck($field)
            ->contains($roleNameOrId);
    }

    /**
     * @param $rolesOrRoleIds - role's id or object. can be array like [1,2,3]
     * @throws \Exception
     */
    public function attach($rolesOrRoleIds)
    {
        if (is_array($rolesOrRoleIds)) {
            foreach ($rolesOrRoleIds as $roleOrRoleId) {
                $this->attachExecute($roleOrRoleId);
            }
        } else {
            $this->attachExecute($rolesOrRoleIds);
        }
    }

    /**
     * @param $roleOrRoleId - role's id or object.
     * @return mixed
     * @throws \Exception
     */
    public function attachExecute($roleOrRoleId)
    {
        if (!is_integer($roleOrRoleId) && !is_object($roleOrRoleId)) throw new \Exception('parameter might be wrong');
        return User::find(Auth::user()->id)
            ->getRoles()
            ->attach($roleOrRoleId);
    }

    /**
     * @param $RoleId - role's id or id of array i.e [1,2,3]
     * @return mixed
     * @throws \Exception
     */
    public function detach($RoleId)
    {
        if (!is_integer($RoleId) && !is_array($RoleId)) throw new \Exception('parameter might be wrong');
        return User::find(Auth::user()->id)
            ->getRoles()
            ->detach($RoleId);
    }
}