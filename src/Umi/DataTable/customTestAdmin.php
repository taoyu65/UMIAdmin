<?php

namespace YM\Umi\DataTable;

class customTestAdmin extends AdminDataTableWithSearch
{
    #这个是一个测试类, 你可以自定义数据表头和尾, 以及你自己的方法.

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
        #you can do any head you want here, delete the following code then adding your header.
        return parent::headerAlert();
    }

    private function yourFooter()
    {
        #you can do any foot you want, delete the following code then adding your footer.
        return parent::footer();
    }
}