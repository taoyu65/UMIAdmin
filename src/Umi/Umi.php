<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

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
        self::$currentTableName = $tableName;
        self::$currentTableId = $this->table->getTableId($tableName);
    }

    public function currentTableName()
    {
        return self::$currentTableName;
    }

    public function currentTableId()
    {
        return self::$currentTableId;
    }

    public function getTableNameById($tableId)
    {
        return $this->table->getTableName($tableId);
    }

    public function getTableIdByTableName($tableName)
    {
        return $this->table->getTableId($tableName);
    }

    public function showMessage($title, $content = '', $options = [], $multiple = true)
    {
        #设置默认的样式为深绿色的界面 gritter-success
        #set default style as a gritter-success
        if (!array_key_exists('class_name', $options))
            $options['class_name'] = 'gritter-success';

        $opt = '';
        foreach ($options as $key => $value) {
            $opt .= "$key:'$value',";
        }

        $html = <<< UMI
        <script>
            $.gritter.add({
                title: '$title',
                text: '$content',
                $opt
            });
        </script>
UMI;
        if (Session::has('showMessage') && $multiple)
            $html .= Session::get('showMessage');

        Session::flash('showMessage', $html);
    }

    #加密 #encrypt
    public function umiEncrypt($str)
    {
        $yuan = Config::get('umi.key_active');
        $jia = Config::get('umi.key_positive');

        $results = '';
        if (strlen($str) == 0) return false;
        for ($i = 0; $i < strlen($str); $i++) {
            if (str_contains($yuan, $str[$i])) {
                for ($j = 0; $j < strlen($yuan); $j++) {
                    if ($str[$i] == $yuan[$j]) {
                        $results .= $jia[$j];
                        break;
                    }
                }
            } else {
                $results .= $str[$i];
            }
        }
        return $results;
    }

    #解密 #decrypt
    public function umiDecrypt($str)
    {
        $yuan = Config::get('umi.key_active');
        $jia = Config::get('umi.key_positive');

        $results = '';
        if (strlen($str) == 0) return false;
        for ($i = 0; $i < strlen($str); $i++) {
            if (str_contains($yuan, $str[$i])) {
                for ($j = 0; $j < strlen($jia); $j++) {
                    if ($str[$i] == $jia[$j]) {
                        $results .= $yuan[$j];
                        break;
                    }
                }
            } else {
                $results .= $str[$i];
            }
        }
        return $results;
    }

    #获取fields参数 用于执行数据表的关联操作 (把此值作为url参数添加到最后)
    #   $record: 当前记录的对象或者数组
    #get parameter "fields" is using for table relation operation (put at the end of url as a parameter)
    #   $record: current record's object or array
    public function parameterTRO($record, $relationOperationRuleList)
    {
        $returnArr = [];
        foreach ($relationOperationRuleList as $item) {
            $activeField = $item->active_table_field;
            $returnArr[$activeField] = $record->$activeField;
        }

        return base64_encode(json_encode($returnArr));
    }

    #序列化后再用base64加密 用于在URL中传输数据, 和它的反向操作
    #serialize and than base64 encrypt for transferring data through URL, and its reverse operation
    public function serializeAndBase64($obj)
    {
        return base64_encode(serialize($obj));
    }
    public function unSerializeAndBase64($string)
    {
        return unserialize(base64_decode($string));
    }

    #用户是否属于系统级别权限用户
    #is the user belongs the system role model
    public function isSystemRole()
    {
        $userName = Auth::user()->name;
        $systemRoleList = Config::get('umi.system_role');
        return in_array($userName, $systemRoleList);
    }
}