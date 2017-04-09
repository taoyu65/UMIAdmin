<?php

namespace YM\Umi\Contracts\Search;

use YM\Models\Search;

interface SearchDataTypeInterface
{
    public function searchFieldInput(Search $search);
}