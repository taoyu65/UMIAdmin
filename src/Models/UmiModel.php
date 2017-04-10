<?php

namespace YM\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UmiModel
{
    #此模型不对应任何数据表, 仅做动态数据查询
    #this model does not relate any data table, only for dynamic data operation

    protected $openCache = true;

    /**
     * @param $tableName
     *          - 获取参数table数据表中的所有符合ids 的数据
     *          - get all the record according to the table and ids of id's list
     * @param $ids
     * @return mixed
     */
    public function getFieldByIds($tableName, $ids)
    {
        $idsUnique = array_values(array_unique($ids));
        $minute = Config::get('umi.cache_minutes');

        if ($this->openCache) {
            return Cache::has($tableName) ?
                Cache::get($tableName)->whereIn('id', $idsUnique):
                Cache::remember($tableName . 'getFieldByIds', $minute, function () use ($tableName, $idsUnique) {
                    return DB::table($tableName)
                        ->whereIn('id', $idsUnique)
                        ->get();
                });
        }
        return DB::table($tableName)
            ->whereIn('id', $idsUnique)
            ->get();
    }

    public function getSelectedTable($tableName, $fields)
    {
        $minute = Config::get('umi.cache_minutes');

        /*if ($this->openCache) {
            return Cache::remember($tableName . 'getSelectedTable', $minute, function () use ($tableName, $fields) {
                return DB::table($tableName)
                    ->select($fields);
            });
        }*/

        return DB::table($tableName)
            ->select($fields);
    }
}