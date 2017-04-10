<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SearchTab extends Model
{
    protected $table = 'umi_search_tab';
    protected $openCache = true;

    private $cachedTable;

    public function __construct()
    {
        if ($this->openCache) {
            $minute = Config::get('umi.cache_minutes');
            $this->cachedTable = Cache::remember($this->table, $minute, function () {
                return DB::table('umi_search_tab')->orderBy('order')->get();
            });
        }
    }

    public function searchTabs($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('table_id', $tableId);
        return self::where('table_id', $tableId)
            ->orderBy('order')
            ->get();
    }
}