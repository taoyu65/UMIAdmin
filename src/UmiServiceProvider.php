<?php

namespace YM;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use YM\Http\Middleware\UmiUrlAuthMiddleware;
use YM\Http\Middleware\BreadAccessMiddleWare;
use YM\Http\Middleware\BreadSubmitMiddleWare;
use YM\Umi\Umi;

class UmiServiceProvider extends ServiceProvider
{
    private $tableNameSpace = 'YM\Models\Table';
    private $administrator = 'YM\Umi\administrator';

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/umi.php', 'umi'
        );

        $this->app->singleton('umi', function () {
            return new Umi();
        });
        $this->app->alias('umi', 'YM\Facades\Umi');

        #注册Umi路由提供者
        #regist Umi route provider
        $this->app->register(UmiRouteProvider::class);

        #注册视图合成器
        #regist view composer that including master page composer
        $this->app->register(ComposerServiceProvider::class);

        #事件提供者
        #regist event service
        $this->app->register(UmiEventServiceProvider::class);

        #数据表(tables)的单例模式
        #singleton for data table 'tables'
        $this->app->singleton($this->tableNameSpace);

        #管理员 administrator
        $this->app->singleton($this->administrator);
    }

    public function boot(Router $router)
    {
        #后台路径权限检测
        #URL authority control to check if has permission to load
        $router->middleware('umi.url.auth', UmiUrlAuthMiddleware::class);

        $router->middleware('umi.bread.access', BreadAccessMiddleWare::class);

        $router->middleware('umi.bread.submit', BreadSubmitMiddleWare::class);
    }

}
