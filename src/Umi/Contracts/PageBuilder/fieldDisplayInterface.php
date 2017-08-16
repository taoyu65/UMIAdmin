<?php

namespace YM\Umi\Contracts\PageBuilder;

interface fieldDisplayInterface
{
    public function showExistRecords($tableName, $tableId);
}