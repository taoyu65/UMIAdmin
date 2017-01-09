<?php

namespace YM\Umi;

use YM\Umi\Contracts\TableRelationOperationInterface;

class TableRelationAdd implements TableRelationOperationInterface
{
    public function operation($operationObjects)
    {
        dd('add operation');
    }
}