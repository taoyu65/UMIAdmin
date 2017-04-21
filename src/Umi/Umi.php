<?php

namespace YM\Umi;

class Umi
{
    private $administrator;
    private $table;

    public function __construct()
    {
        $this->administrator = app('YM\Umi\administrator');
        $this->table = app('YM\Models\Table');
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

    public function getTableNameById($tableId)
    {
        return $this->table->getTableName($tableId);
    }

    public function getTableIdByTableName($tableName)
    {
        return $this->table->getTableId($tableName);
    }
}