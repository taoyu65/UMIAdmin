<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SearchTab extends Model
{
    protected $table = 'umi_search_tab';

    private $cacheSearch;

    public function __construct()
    {
//        $minute = Config::get('umi.cache_minutes');
//        $this->cacheSearch = Cache::remember('searchTable', $minute, function () {
//            return DB::table('umi_search_tab')->orderBy('order');
//        });


    }

    public function searchTabs($tableId)
    {
        return self::where('table_id', $tableId)
            ->orderBy('order')
            ->get();
        /*return self::where('table_id', $tableId)
            ->orderBy('order')
            ->get();*/
    }
}