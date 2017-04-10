<?php

namespace YM\Umi\Search\DataType;

use YM\Umi\Contracts\Search\SearchDataTypeInterface;

class SearchDataTypeAbstract implements SearchDataTypeInterface
{
    public function searchFieldInput ($search)
    {
        $displayName = $search->display_name;
        $id = $search->id;
        $field = $search->field;

        $html = <<<UMI

		<div class="col-sm-3">
		    <label>$displayName</label>: &nbsp;
			<input type="text" name="$field-$id"  />
		</div>
UMI;
        return $html;
    }
}