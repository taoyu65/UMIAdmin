<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class UserRole extends Model
{
    use BreadOperation;

    protected $table = 'umi_user_role';
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->fillable = Config::get('umiEnum.fillable.umi_user_role');
        parent::__construct($attributes);
    }

    public function updateUserRole($userId, $roleId)
    {
        $record = self::where('user_id', $userId)
            ->where('role_id', $roleId)
            ->first();
        if (!$record) {
            self::create(['user_id'   => $userId,
                'role_id'   => $roleId]);
            return true;
        }
        return false;
    }
}