<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UmiBase extends Model
{
    #是否开启当前表缓存
    #if open cache for current table
    protected $openCache = false;

    #是否缓存整个当前数据表
    #if cache all the records from current table
    protected $cacheAllRecord = false;

    #当前表缓存数据
    #all records from cached current able
    protected $cachedTable = null;

    #缓存时间设置
    #how many minutes for the cache
    private $minute;

    public $timestamps = false;

    public function __construct(array $attributes = [], $orderBy = '', $order = 'asc')
    {
        parent::__construct($attributes);

        if (!$this->cacheAllRecord) return;

        $tableName = $this->table;

        $this->minute = Config::get('umi.cache_minutes');

        $this->cachedTable = Cache::remember($tableName, $this->minute, function () use ($tableName, $orderBy, $order) {
            return $orderBy === '' ?
                DB::table($tableName)->get() :
                DB::table($tableName)->orderBy($orderBy, $order)->get();
        });
    }
}