<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Badge extends Model
{
    protected $table = 'umi_badges';
    protected $openCache = true;

    private $cachedTable;

    public function __construct()
    {
        if ($this->openCache) {
            $minute = Config::get('umi.cache_minutes');
            $this->cachedTable = Cache::remember($this->table, $minute, function () {
                return DB::table('umi_badges')->get();
            });
        }
    }

    public function getBadges($tableId, $field)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('table_id', $tableId)
                ->where('field', 'type');
                //->pluck('class', 'badge_name');

        return self::select('badge_name', 'class')
            ->whereTable_idAndField($tableId, $field)
            ->get();
    }
}