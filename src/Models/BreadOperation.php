<?php

namespace YM\Models;

use Illuminate\Support\Facades\Cache;

trait BreadOperation
{
    public function insert($inputs)
    {
        try {
            self::create($inputs);
            Cache::pull($this->table);
        } catch (\Exception $exception) {
            abort(503, $exception->getMessage());
        }
    }
}