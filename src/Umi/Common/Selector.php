<?php

namespace YM\Umi\Common;

use YM\Facades\Umi;

class Selector
{
    public $title;
    public $tip;

    #选择之后调用父窗口的函数名称 (默认自带参数, 参数为返回返回父窗口的值)
    #function name from parent window that will be called after selected (default a parameter that is a value for parent window is going to return to)
    public $functionName;

/*    #用于接受所选择的值的DOM ID
    #DOM ID that accepts the value from choosing
    public $receivedDomId;*/

    #哪个列的值将会被选择并且返回
    #which value from column will be selected and returned
    public $returnField;

    #用于在新窗口显示哪些字段被显示 (['字段1', '字段2'])
    #which fields will be showing on the window (['filed1', 'field2'])
    public $fields = [];

    #用于搜索的字段
    #field of searching
    public $searchField;

    public function __construct()
    {
        $this->title = 'Selector';
        $this->returnField = 'id';
    }

    #转变json并且加密 作为url参数请求相应的功能
    #turn into json and encrypt as part of url for requesting a related function
    public function serialize()
    {
        return base64_encode(serialize($this));
        //return Umi::umiEncrypt(json_encode($this));
    }

    public function unSerialize($string)
    {
        return unserialize(base64_decode($string));
        //return json_decode(Umi::umiDecrypt($string));
    }
}