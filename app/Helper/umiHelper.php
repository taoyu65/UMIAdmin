<?php

if (! function_exists('url_with_para')) {
    function url_with_para($path) {
        $parameter = $_SERVER['QUERY_STRING'];
        $url = $parameter == '' ? url($path) : url($path) . '?' . $parameter;
        return $url;
    }
}

if (!function_exists('time_tran')) {
    function time_tran($the_time)
    {
        $now_time = date("Y-m-d H:i:s");
        $now_time = strtotime($now_time);
        $show_time = strtotime($the_time);
        $dur = $now_time - $show_time;
        if ($dur < 0) {
            return $the_time;
        } else {
            if ($dur < 60) {
                return $dur . 'secs before';
            } else {
                if ($dur < 3600) {
                    return floor($dur / 60) . 'minutes before';
                } else {
                    if ($dur < 86400) {
                        return floor($dur / 3600) . 'hours before';
                    } else {
                        if ($dur < 259200) {
                            return floor($dur / 86400) . 'days before';
                        } else {
                            return date('dMY', strtotime($the_time));
                        }
                    }
                }
            }
        }
    }
}