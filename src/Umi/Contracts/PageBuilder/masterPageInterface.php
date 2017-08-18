<?php

namespace YM\Umi\Contracts\PageBuilder;

interface masterPageInterface
{
    public function masterPageHead();

    public function masterPageBody();

    public function masterPageFoot();
}