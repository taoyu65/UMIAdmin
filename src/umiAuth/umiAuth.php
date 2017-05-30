<?php

namespace YM\umiAuth;

use YM\umiAuth\src\Contracts\umiAuthInterface;
use YM\umiAuth\src\Models\User;
use YM\umiAuth\Traits\umiAuthPermissionTrait;
use YM\umiAuth\Traits\umiAuthRoleTrait;

class umiAuth implements umiAuthInterface
{
    use umiAuthRoleTrait;
    use umiAuthPermissionTrait;

    private $User;

    public function __construct()
    {
        $this->User = new User();
    }

    /**
     * @param $roles
     *      - 角色名称 (可以为数组) 或者角色ID (可以为数组)
     *      - role's name (can be array) or role's ID (can be array)
     * @param $permissions
     *      - 权限名称 (格式: "动作-表名")
     *      - permission's name (format: "action-tableName")
     * @param array $options
     * @return array|bool
     * @throws \Exception
     */
    public function ability($roles, $permissions, $options = [])
    {
        #设置默认值
        #default the options
        if (!isset($options['validate_all']))
            $options['validate_all'] = false;
        if (!is_bool($options['validate_all']))
            throw new \Exception('parameter might be wrong');
        if (!isset($options['return_type']))
            $options['return_type'] = 'boolean';
        if (!in_array($options['return_type'], ['boolean','array','both']))
            throw new \Exception('parameter might be wrong');

        $checkedRoles = [];
        $checkedPermissions = [];

        foreach ($roles as $role)
            $checkedRoles[$role] = $this->hasRoleExecute($role);
        foreach ($permissions as $permission)
            $checkedPermissions[$permission] = $this->hasPermission($permission);

        #如果检查全部 必须全部为真则返回真, 如果检查部分(不检查全部) 只要有一条为真则返回真
        #if validate_all is true all the result must be true than return true, if validate_all is false only one result is true than return true
        $validateAll = $options['validate_all'] ?
            !in_array(false, $checkedRoles, true) && !in_array(false, $checkedPermissions, true) :
            in_array(true, $checkedRoles, true) || in_array(true, $checkedPermissions, true);

        switch ($options['return_type']) {
            case 'boolean':
                return $validateAll;
            case 'array':
                return ['roles' => $checkedRoles, 'permissions' => $checkedPermissions];
            case 'both':
                return [$validateAll, ['roles' => $checkedRoles, 'permissions' => $checkedPermissions]];
            default:
                throw new \Exception('parameter might be wrong');
        }
    }
}