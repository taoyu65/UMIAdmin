<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Request;

class Umi
{
    public function __construct()
    {
    }

    #not completed for breadcrumb function
    public function breadcrumb()
    {
        $result = [];
        $pars = Request::segments();//var_dump($pars);
        $count = count($pars);
        $breadcrumbs = Config::get('umiBreadcrumbs.dashboard');

        for ($i = $count - 1; $i < $count; $i--) {
            $par = $pars[$i];

        }

        return $result;
    }

    public function recursion($breadcrumbs, $target)
    {
        foreach ($breadcrumbs as $breadcrumb) {
            if (array_key_exists($target, $breadcrumb)) {

            }
            if (array_key_exists('children', $breadcrumb)) {
                $this->recursion($breadcrumb);
            }
        }
    }

    public function can()
    {
        return true;
    }
}