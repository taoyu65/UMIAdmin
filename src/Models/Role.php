<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'umi_roles';

    private $modelNameSpace = 'YM\Models';

    public function Permission()
    {
        $related = $this->modelNameSpace . '\Permission';
        return $this->belongsToMany($related, 'umi_permission_role', 'role_id', 'permission_id');
    }
}