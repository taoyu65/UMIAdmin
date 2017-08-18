<?php

namespace YM\Umi\Contracts\PageBuilder;

interface nestableInterface
{
    public function showDragDropTree($tableName, $showButton = false, $buttonException = []);

    public function showDragDropTreeByJson($jsonArr);
}