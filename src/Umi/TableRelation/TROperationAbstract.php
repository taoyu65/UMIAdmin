<?php

namespace YM\Umi\TableRelation;

use YM\Umi\Contracts\TableRelation\TROperationInterface;

class TROperationAbstract implements TROperationInterface
{
    public function operation($activeTableName, $activeField, $activeFieldValue, $responseTableName, $responseField)
    {

    }
}