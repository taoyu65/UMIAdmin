<?php

namespace YM\Umi\Contracts\PageBuilder;

interface tableBreadInterface
{
    public function display($records, $defaultValue, $buttonType);
}