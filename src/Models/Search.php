<?php

namespace YM\Models;

class Search extends UmiBase
{
    protected $table = 'umi_search';

    protected $openCache = true;
    protected $cacheAllRecord = true;

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