<?php

namespace App\Base\Providers;

use App\Api\Providers\ApiServiceProvider;
use App\Web\Providers\WebServiceProvider;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    //路由文件名
    protected $routes = 'routes.php';

    public function boot()
    {
        //sql打印 不提交
       /* \DB::listen(function ($query) {
            $sql = array_reduce($query->bindings, function($sql, $binding) {
                return preg_replace('/\?/', is_numeric($binding) ? $binding : sprintf("'%s'", $binding), $sql, 1);
            }, $query->sql);

            \Log::info($sql);
        });*/
        //自动载入路由
        $func = new \ReflectionClass(get_class($this));
        $path = str_replace($func->getShortName() . '.php', '', $func->getFileName());
        $routesFile = $path . '../' . $this->routes;
        if (file_exists($routesFile)) {
            require $routesFile;
        }

        if (! isset($this->app['blade.compiler'])) {
            $this->app['view'];
        }
        parent::boot();
    }


    /**
     * 注册
     */
    public function register()
    {
        $this->app->register(WebServiceProvider::class);
        $this->app->register(ApiServiceProvider::class);
    }
}
