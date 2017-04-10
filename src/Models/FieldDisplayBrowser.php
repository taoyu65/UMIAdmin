<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class FieldDisplayBrowser extends Model
{
    protected $table = 'umi_field_display_browser';
    protected $openCache = true;

    private $cachedTable;
    //private $minute;

    public function __construct()
    {
        if ($this->openCache) {
            //$this->minute = Config::get('umi.cache_minutes');
            $minute = Config::get('umi.cache_minutes');
            $this->cachedTable = Cache::remember($this->table, $minute, function () {
                return DB::table('umi_field_display_browser')->orderBy('order')->get();
            });
        }
    }

    public function DataSetBrowser($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('table_id', $tableId)
                ->where('is_showing', 1);

        return self::where('table_id', $tableId)
            ->where('is_showing', 1)
            ->get();
    }
}