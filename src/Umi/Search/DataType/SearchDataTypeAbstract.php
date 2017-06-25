<?php

namespace YM\Umi\Search\DataType;

use YM\Umi\Contracts\Search\SearchDataTypeInterface;

class SearchDataTypeAbstract implements SearchDataTypeInterface
{
    public function searchFieldInput ($search)
    {
        $displayName = $search->display_name;
        $property = $this->getProperty($search);

        $html = <<<UMI
        <div class="col-sm-3">
            <label>$displayName</label>: &nbsp;
            <input type="text" $property/>
        </div>
UMI;
        return $html;
    }

    #生成用于搜索的字段的名称
    #generate a name value of input
    protected function getProperty($search)
    {
        return "name=\"$search->field-$search->id\"";
    }
}