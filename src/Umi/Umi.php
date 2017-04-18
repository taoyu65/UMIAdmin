<?php

namespace YM\Umi;

class Umi
{
    private $administrator;

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
        $this->administrator->setCurrentTableName($tableName);
    }

    public function currentTableName()
    {
        return $this->administrator->getCurrentTableName();
    }

    public function currentTableId()
    {
        return $this->administrator->getCurrentTableId();
    }
}