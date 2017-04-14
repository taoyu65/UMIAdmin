<?php

namespace YM\Umi\Contracts\TableRelation;

interface TROperationInterface
{
    public function operation($activeTableId, $activeFieldId, $responseTableId, $responseField);
}