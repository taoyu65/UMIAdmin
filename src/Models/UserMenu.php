<?php

namespace YM\Models;

class UserMenu extends UmiBase
{
    protected $table = 'umi_user_menu';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function userJsonMenu($userId)
    {
        if ($this->openCache) {
            return $this->cachedTable
                ->where('user_id', $userId)
                ->first()
                ->json;
        }

        return self::where('user_id', $userId)
            ->first()
            ->json;
    }
}