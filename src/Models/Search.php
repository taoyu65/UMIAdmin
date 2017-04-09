<?php
namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
class Search extends Model
{
    protected $table = 'umi_search';

    private $search;

    public function content($tabIdList)
    {
        $minute = Config::get('umi.cache_minutes');
        $tableName = Umi::currentTableName();
        //todo 将查询移动到缓存中
        return self::whereIn('search_tab_id', $tabIdList)->get();
        /*$this->search = Cache::remember('search' . $tableName, $minute, function () use ($tabIdList) {

                ->get();
        });*/
    }

    public function getSearchByTabId($tabId)
    {
        return self::where('search_tab_id', $tabId)
            ->get();
    }
}