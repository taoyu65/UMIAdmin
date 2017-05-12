<?php

if (! function_exists('url_with_para')) {
    function url_with_para($path) {
        $parameter = $_SERVER['QUERY_STRING'];
        $url = $parameter == '' ? url($path) : url($path) . '?' . $parameter;
        return $url;
    }
}