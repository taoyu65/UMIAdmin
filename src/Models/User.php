<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    private $modelNameSpace = 'YM\Models';

    public function MenuJson()
    {
        return $this->hasOne($this->modelNameSpace . '\UserMenu', 'user_id');
    }
}