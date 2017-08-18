<?php

namespace YM\Umi;

use YM\Umi\PageBuilder\umiDataTableBuilder_ACE;
use YM\Umi\PageBuilder\umiDataTableBuilder_LTE;
use YM\Umi\PageBuilder\umiFieldDisplayBuilder_ACE;
use YM\Umi\PageBuilder\umiFieldDisplayBuilder_LTE;
use YM\Umi\PageBuilder\umiMasterPageBuilder_ACE;
use YM\Umi\PageBuilder\umiMasterPageBuilder_LTE;
use YM\Umi\PageBuilder\umiMenusBuilder_ACE;
use YM\Umi\PageBuilder\umiMenusBuilder_LTE;
use YM\Umi\PageBuilder\umiNestableBuilder_ACE;
use YM\Umi\PageBuilder\umiNestableBuilder_LTE;
use YM\Umi\PageBuilder\umiSearchBuilder_ACE;
use YM\Umi\PageBuilder\umiSearchBuilder_LTE;
use YM\Umi\PageBuilder\umiTableBreadBuilder_ACE;
use YM\Umi\PageBuilder\umiTableBreadBuilder_LTE;

class FactoryUI
{
    private $ui;

    function __construct()
    {
        $this->ui = config('umi.current_ui');
    }

    #主页面(master page)头部, 脚部, 和内容的加载
    #loading head, foot body (master page)
    public function masterPageUI()
    {
        switch ($this->ui) {
            case 'ace':
                return new umiMasterPageBuilder_ACE();
            case 'lte':
                return new umiMasterPageBuilder_LTE();
            default:
                return new umiMasterPageBuilder_LTE();
        }
    }

    #主页面(master page)的左边菜单的加载
    #loading master page left menus
    public function masterPageMenuUI()
    {
        switch ($this->ui) {
            case 'ace':
                return new umiMenusBuilder_ACE();
            case 'lte':
                return new umiMenusBuilder_LTE();
            default:
                return new umiMenusBuilder_LTE();
        }
    }

    #加载数据表格, 用于浏览数据
    #loading data table for browser view
    public function dataTableUI()
    {
        switch ($this->ui) {
            case 'ace':
                return new umiDataTableBuilder_ACE();
            case 'lte':
                return new umiDataTableBuilder_LTE();
            default:
                return new umiDataTableBuilder_LTE();
        }
    }

    #加载搜索
    #loading search
    public function searchUI()
    {
        switch ($this->ui) {
            case 'ace':
                return new umiSearchBuilder_ACE();
            case 'lte':
                return new umiSearchBuilder_LTE();
            default:
                return new umiSearchBuilder_LTE();
        }
    }

    #加载数据字段
    #loading data field
    public function fieldDisplayUI()
    {
        switch ($this->ui) {
            case 'ace':
                return new umiFieldDisplayBuilder_ACE();
            case 'lte':
                return new umiFieldDisplayBuilder_LTE();
            default:
                return new umiFieldDisplayBuilder_LTE();
        }
    }

    #加载用户菜单 以nestable插件的方式显示
    #loading user menus as nestable plugin shows
    public function nestableUI()
    {
        switch ($this->ui) {
            case 'ace':
                return new umiNestableBuilder_ACE();
            case 'lte':
                return new umiNestableBuilder_LTE();
            default:
                return new umiNestableBuilder_LTE();
        }
    }

    #数据表操作的相关加载
    #table BREAD related operation loading
    public function tableBreadUI()
    {
        switch ($this->ui) {
            case 'ace':
                return new umiTableBreadBuilder_ACE();
            case 'lte':
                return new umiTableBreadBuilder_LTE();
            default:
                return new umiTableBreadBuilder_LTE();
        }
    }
}