<?php

namespace YM\Umi\Contracts\TableRelation;

interface TROperationInterface
{
    public function operation($activeTableName, $activeField, $activeFieldValue, $responseTableName, $responseField);
}