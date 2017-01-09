<?php

namespace YM\Umi;

use YM\Umi\Contracts\TableRelationOperationInterface;

class TableRelation
{
    private $TableRelationOperation;

    public function __construct(TableRelationOperationInterface $droInterface)
    {
        $this->TableRelationOperation = $droInterface;
    }

    public function executeOperation($operationObjects)
    {
        return $this->TableRelationOperation->operation($operationObjects);
    }
}