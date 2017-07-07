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

    #根据不同动态BREAD来判断权限
    #based on the action BREAD to return the permission
    public function actionPermission($action)
    {
        switch ($action) {
            case 'browser':
                return $this->browserPermission();
            case 'read':
                return $this->readPermission();
            case 'edit':
                return $this->readPermission();
            case 'add':
                return $this->addPermission();
            case 'delete':
                return $this->deletePermission();
            default:
                return false;
        }
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
            $this->admin->readPermission();
    }

    public function editPermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->admin->editPermission();
    }

    public function addPermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->admin->addPermission();
    }

    public function deletePermission()
    {
        return $this->hasSuperPermission() ?
            true :
            $this->admin->deletePermission();
    }
}