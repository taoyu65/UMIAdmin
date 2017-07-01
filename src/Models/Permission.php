<?php

namespace YM\Models;

use Illuminate\Support\Facades\DB;

class Permission extends UmiBase
{
    use BreadOperation;

    protected $table = 'umi_permissions';
    public $timestamps = true;

    protected $openCache = true;
    protected $cacheAllRecord = true;

    #获取所有权限字符串 比如(edit1, 权限+数据表id)
    #get all permissions string, such as (edit1, permission plus table id)
    public function allPermission()
    {
        if ($this->openCache)
            return $this->cachedTable
                ->map(function ($item) {
                    return $item->key.$item->table_id;
                })
                ->toArray();

        return self::all()
            ->map(function ($item) {
                return $item->key . $item->table_id;
            })
            ->toArray();
    }

    #和方法allPermission基本相同, 不同方法实现而已
    #same function with allPermission, just different method to implement
    public function allPermissionRegulated()
    {
        return self::select(DB::raw('CONCAT(`key`, `table_id`) as `permission`'), 'id')
            ->get()
            ->pluck('id', 'permission')
            ->toArray();
    }
}