<?php

namespace YM\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
            $userMenu = $this->cachedTable->where('user_id', $userId)->first();
        } else {
            $userMenu = self::where('user_id', $userId)->first();
        }

        if ($userMenu) {
            return $userMenu->json;
        } else {
            DB::table($this->table)
                ->insert([
                    'user_id'   => $userId,
                    'json'      => '[]'
                ]);
            Cache::pull($this->table);
            return '[]';
        }
    }

    public function updateUserMenu($userId, $json)
    {
        return self::where('user_id', $userId)
            ->update(['json' => $json]);
    }
}