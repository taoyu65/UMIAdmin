<?php

namespace YM\Models;

class UserMenu extends UmiBase
{
    use BreadOperation;

    protected $table = 'umi_user_menu';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct(array $attributes = [], $openCache = true, $orderBy = '', $order = 'asc')
    {
        parent::__construct($attributes = [], $orderBy, $order);

        $this->openCache = $openCache;
    }

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

    public function updateUserMenu($userId, $json)
    {
        return self::where('user_id', $userId)
            ->update(['json' => $json]);
    }
}