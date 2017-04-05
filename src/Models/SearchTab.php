<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class SearchTab extends Model
{
    protected $table = 'umi_search_tab';

    public function searchTabs($tableId)
    {
        return self::where('table_id', $tableId)
            ->orderBy('order')
            ->get();
    }
}