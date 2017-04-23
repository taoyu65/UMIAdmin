<?php

namespace YM\Umi;

class Umi
{
    private $administrator;
    private $table;

    private static $currentTableName;
    private static $currentTableId;

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
        //$this->administrator->setCurrentTableName($tableName);
        self::$currentTableName = $tableName;
        self::$currentTableId = $this->table->getTableId($tableName);
    }

    public function currentTableName()
    {
        //return $this->administrator->getCurrentTableName();
        return self::$currentTableName;
    }

    public function currentTableId()
    {
        return self::$currentTableId;
        //return $this->administrator->getCurrentTableId();
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