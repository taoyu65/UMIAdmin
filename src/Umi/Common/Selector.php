<?php

namespace YM\Umi\Common;

class Selector
{
    public $title;
    public $tip;

    #选择之后调用的函数名称 (函数名称 => ['参数'])
    #function name that will be called after selected (functionName => ['parameters'])
    public $callback = [];

    #用于接受所选择的值的DOM ID
    #DOM ID that accepts the value from choosing
    public $receivedDomId;

    #哪个列的值将会被选择并且返回
    #which value from column will be selected and returned
    public $selectTarget;

    #用于在新窗口显示哪些字段被显示 (['字段1', '字段2'])
    #which fields will be showing on the window (['filed1', 'field2'])
    public $fields = [];

    public function __construct()
    {
        $this->title = 'Selector';
        $this->selectTarget = 'id';
    }
}