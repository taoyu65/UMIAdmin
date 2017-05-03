<?php

namespace YM\Umi;

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

    public function showMessage($title, $content = '', $options = [])
    {
        #设置默认的样式为深绿色的界面 gritter-sucdess
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
        Session::flash('showMessage', $html);
    }
}