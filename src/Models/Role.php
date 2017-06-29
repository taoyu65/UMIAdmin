<?php

namespace YM\Models;

class Role extends UmiBase
{
    protected $table = 'umi_roles';
    public $timestamps = true;

    private $modelNameSpace = 'YM\Models';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function permission()
    {
        $related = $this->modelNameSpace . '\Permission';
        return $this->belongsToMany($related, 'umi_permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany($this->modelNameSpace . '\User', 'umi_user_role', 'role_id','user_id');
    }

    public function roleNameList()
    {
        if ($this->openCache)
            return $this->cachedTable
                ->pluck('role_name', 'id')
                ->toJson();

        return self::select('id', 'role_name')
            ->pluck('role_name', 'id')
            ->toJson();
    }
}