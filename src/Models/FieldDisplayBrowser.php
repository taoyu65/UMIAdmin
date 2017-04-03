<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class FieldDisplayBrowser extends Model
{
    protected $table = 'umi_field_display_browser';

    private $minute;

    public function __construct()
    {
        $this->minute = Config::get('umi.cache_minutes');
    }

    public function DataSetBrowser($tableId)
    {
        return Cache::remember('dataSetBrowser' . $tableId, $this->minute, function () use ($tableId){
            return self::where('table_id', $tableId)
                ->where('is_showing', 1)
                ->orderBy('order')
                ->get();
        });
    }
}