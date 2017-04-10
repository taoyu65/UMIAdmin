<?php
namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Search extends Model
{
    protected $table = 'umi_search';
    protected $openCache = true;

    private $cachedTable;

    public function __construct()
    {
        if ($this->openCache) {
            $minute = Config::get('umi.cache_minutes');
            $this->cachedTable = Cache::remember($this->table, $minute, function () {
                return DB::table('umi_search')->get();
            });
        }
    }

    public function content($tabIdList)
    {
        if ($this->openCache)
            return $this->cachedTable->whereIn('search_tab_id', $tabIdList);
        return self::whereIn('search_tab_id', $tabIdList)->get();
    }

    public function getSearchByTabId($tabId)
    {
        if ($this->openCache)
            return $this->cachedTable->where('search_tab_id', $tabId);
        return self::where('search_tab_id', $tabId)
            ->get();
    }
}