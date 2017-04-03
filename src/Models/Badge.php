<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $table = 'umi_badges';

    public function getBadges($tableId, $field)
    {
        return self::select('badge_name', 'class')
            ->whereTable_idAndField($tableId, $field)
            ->get();
    }
}