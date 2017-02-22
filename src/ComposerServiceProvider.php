<?php

namespace YM;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    #为主模板加载菜单(权限), 页头, 页尾
    #loading menus for master page, top of page and bottom
    public function boot()
    {
        View::composer(
            'umi::layouts.master', 'YM\Http\ViewComposers\MasterComposer'
        );
    }
}