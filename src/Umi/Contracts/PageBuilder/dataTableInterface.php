<?php

namespace YM\Umi\Contracts\PageBuilder;

interface dataTableInterface
{
    public function tableHeadAlert();

    public function tableHead();

    public function tableBody();

    public function tableFoot();
}