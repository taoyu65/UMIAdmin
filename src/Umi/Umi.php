<?php

namespace YM\Umi;

class Umi
{
    private $administrator;

    protected $currentTableName;
    protected $currentTableId;

    public function __construct()
    {
        $this->administrator = app('YM\Umi\administrator');
    }

    public function userName()
    {
        return $this->administrator->UserName();
    }

    public function setCurrentTableName($tableName)
    {
        $this->currentTableName = $tableName;
        $this->currentTableId = $this->administrator->getCurrentTableId($tableName);
    }

    public function currentTableName()
    {
        return $this->currentTableName;
    }

    public function currentTableId()
    {
        return $this->currentTableId;
    }
}