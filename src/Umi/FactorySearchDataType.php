<?php

namespace YM\Umi;

use YM\Umi\Search\DataType\RadioSearchType;
use YM\Umi\Search\DataType\TextBoxSearchType;

class FactorySearchDataType
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function getInstance()
    {
        switch ($this->type) {
            case 'textBox':
                return new TextBoxSearchType();
            case 'radio':
                return new RadioSearchType();
            default:
                return null;
        }
    }
}