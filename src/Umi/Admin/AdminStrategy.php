<?php

namespace YM\Umi\Admin;

use YM\Umi\FactoryAdmin;

class AdminStrategy
{
    private $admin;
    private $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;

        $factory = new FactoryAdmin();
        $this->admin = $factory->getAdmin();
    }

    public function hasSuperPermission()
    {
        return $this->admin->hasSuperPermission();
    }

    public function tableHead()
    {
        return $this->admin->generateBrowserTable($this->tableName)->header();
    }

    public function tableBody()
    {
        return $this->admin->generateBrowserTable($this->tableName)->tableBody();
    }

    public function tableFoot()
    {
        return $this->admin->generateBrowserTable($this->tableName)->footer();
    }

    public function browserPermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->admin->browserPermission();
    }

    public function readPermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->readPermission();
    }

    public function editPermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->editPermission();
    }

    public function addPermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->addPermission();
    }

    public function deletePermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->deletePermission();
    }
}