<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'umi_user_role';

    public function updateUserRole($userId, $roleId)
    {
        $record = self::where('user_id', $userId)
            ->where('role_id', $roleId)
            ->first();
        if (!$record) {
            self::create([
                'user_id'   => $userId,
                'role_id'   => $roleId
            ]);
            return true;
        }
        return false;
    }
}