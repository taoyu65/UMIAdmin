<?php

namespace YM;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use YM\Http\Middleware\UmiUrlAuthMiddleware;
use YM\Umi\Umi;

class UmiServiceProvider extends ServiceProvider
{
    private $tableNameSpace = 'YM\Models\Table';
    private $administrator = 'YM\Umi\administrator';

    public function register()
    {
        $this->app->singleton('umi', function () {
            return new Umi();
        });

        #注册Umi路由提供者
        #regist Umi route provider
        $this->app->register(UmiRouteProvider::class);

        #注册视图合成器
        #regist view composer that including master page composer
        $this->app->register(ComposerServiceProvider::class);

        #数据表(tables)的单例模式
        #singleton for data table 'tables'
        $this->app->singleton($this->tableNameSpace);

        #管理员 administrator
        $this->app->singleton($this->administrator);
    }

    public function boot(Router $router)
    {
        #后台路径权限控制 : 菜单加载的时候获取哪个菜单显示
        #URL authority control : when menus are loading to determine which one will be shown
        $router->middleware('umi.url.auth', UmiUrlAuthMiddleware::class);
    }

}
