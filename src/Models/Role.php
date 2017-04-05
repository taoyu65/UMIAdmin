<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'umi_roles';

    private $modelNameSpace = 'YM\Models';

    public function permission()
    {
        $related = $this->modelNameSpace . '\Permission';
        return $this->belongsToMany($related, 'umi_permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany($this->modelNameSpace . '\User', 'umi_user_role', 'role_id','user_id');
    }
}