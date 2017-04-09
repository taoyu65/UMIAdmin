<?php

namespace YM\Umi\Search\DataType;

use YM\Models\Search;
use YM\Umi\Contracts\Search\SearchDataTypeInterface;

class SearchDataTypeAbstract implements SearchDataTypeInterface
{
    public function searchFieldInput (Search $search)
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