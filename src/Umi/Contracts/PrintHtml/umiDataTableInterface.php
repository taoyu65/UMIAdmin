<?php

namespace YM\Umi\Contracts\PrintHtml;

interface umiDataTableInterface extends PrintHtmlInterface
{
    public function header();

    public function tableBody();

    public function footer();
}