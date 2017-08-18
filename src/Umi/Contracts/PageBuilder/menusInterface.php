<?php

namespace YM\Umi\Contracts\PageBuilder;

interface menusInterface
{
    public function AllMenus();

    /**
     * 根据不同的json加载不同菜单
     * load different menus according to the json
     * @param string $json
     *              - 为空    : 根据当前用户从数据库加载json  get json by search from database according to current user
     *              - 不为空   : 根据参数加载json    get json by the parameter has given
     * @return string
     * @throws Exception
     */
    public function Menus($json = '');
}