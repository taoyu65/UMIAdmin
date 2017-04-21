<?php

namespace YM\Umi\DataTable;

class customTestAdmin extends AdminDataTableWithSearch
{
    #这个是一个测试类, 你可以自定义数据表头和尾, 以及你自己的方法.
    #this is test class shows you can make your own class that you can customize the top, bottom or method of data table

    protected $head;
    protected $foot;

    public function __construct()
    {
        parent::__construct();

        $this->head = $this->yourHeader();
        $this->foot = $this->yourFooter();
    }

    private function yourHeader()
    {
        #填写并设计你自己的表格头 并且删除调用父类
        #you can do any head you want here, delete the following code then adding your header.
        return parent::headerAlert();
    }

    private function yourFooter()
    {
        #填写并设计你自己的表格尾 并且删除调用父类
        #you can do any foot you want, delete the following code then adding your footer.
        return parent::footer();
    }
}