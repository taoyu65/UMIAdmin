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
    protected $CacheSmallThan = 100;     //根据此值是否决定缓存  will no be cached when over sized

    private $cachedTable;
    private $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;

        if ($this->openCache && $tableName != ''){
            $minute = Config::get('umi.cache_minutes');

            #根据设定的值大小 是否进行缓存整个数据表 并且缓存此次数据库查询记录数
            #according to the size of number to see if cache the whole data table, and cache the amount number
            $tableCount = Cache::remember($tableName.'count', $minute, function () use ($tableName) {
                return DB::table($tableName)->count();
            });
            if ($tableCount > $this->CacheSmallThan)
                return;

            $this->cachedTable = Cache::remember($tableName, $minute, function () use ($tableName) {
                return DB::table($tableName)->get();
            });
        }
    }

    public function getRowById($id)
    {
        $minute = Config::get('umi.cache_minutes');

        if ($this->openCache) {
            return Cache::has($this->tableName) ?
                Cache::get($this->tableName)->where('id', $id)->first():
                Cache::remember($this->tableName . 'getRowById', $minute, function () use ($id) {
                    return DB::table($this->tableName)
                        ->where('id', $id)
                        ->first();
                });
        }

        return DB::table($this->tableName)
            ->whereIn('id', $id)
            ->first();
    }

    public function getRecordsByFields($fields)
    {
        $page = 1;//todo - per page need to go through config file, this is for test //Config::get('umi.umi_table_perPage');
        return DB::table($this->tableName)
            ->select($fields)
            ->paginate($page);
    }

    public function getSelectedTable($fields)
    {
        return DB::table($this->tableName)
            ->select($fields);
    }

    public function delete($id)
    {
        return DB::table($this->tableName)->whereId($id)->delete();
    }
}