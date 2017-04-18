<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use YM\Models\Table;

/**
 * register as a singleton, the class keep all the status of user
 * 注册为单例, 这个类记录管理员的状态
 */
class administrator
{
    private $isSuperAdmin = false;
    private $minute;
    private $userName;

    protected $tableName;
    protected $tableId;

    public function __construct()
    {
        $this->minute = Config::get('umi.cache_minutes');
        $this->userName = Auth::user()->name;
    }

    public function isSuperAdmin()
    {
        if (Config::get('umi.url_auth')) {
            $this->isSuperAdmin = $this->userName === Config::get('umi.super_admin') ? true : false;
        } else {
            $this->isSuperAdmin = true;
        }
        return $this->isSuperAdmin;
    }

    public function userName()
    {
        return $this->userName;
    }

    public function setCurrentTableName($tableName)
    {
        $this->tableName = $tableName;
        $this->tableId = $this->setCurrentTableId($tableName);
    }

    public function setCurrentTableId($tableName)
    {
        //$table = new Table();
        $table = app('YM\Models\Table');
        $this->tableId = $table->getTableId($tableName);
        return $this->tableId;
    }

    public function getCurrentTableName()
    {
        return $this->tableName;
    }

    public function getCurrentTableId()
    {
        return $this->tableId;
    }
}