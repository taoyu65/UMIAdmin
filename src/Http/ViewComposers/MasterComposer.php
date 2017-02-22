<?php

namespace YM\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use YM\Umi\FactoryMasterPage;

class MasterComposer
{
    public function compose(View $view)
    {
        $factory = new FactoryMasterPage();
        $mastPage = $factory->getMasterPage();
        $header = $mastPage->header();
        $body = $mastPage->body();
        $footer = $mastPage->footer();
        $sideMenu = $mastPage->sideMenu();
        $view->with('header', $header);
        $view->with('body', $body);
        $view->with('footer', $footer);
        $view->with('sideMenu', $sideMenu);
    }
}