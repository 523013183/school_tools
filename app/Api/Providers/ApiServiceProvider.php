<?php
/**
 * Created by PhpStorm.
 * User: fangx
 * Date: 2021/7/23
 * Time: 9:42
 */

namespace App\Api\Providers;

use App\Api\Facades\ApiFacade;
use App\Api\Services\ApiService;
use App\Base\Providers\AppServiceProvider;

class ApiServiceProvider extends AppServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    /**
     * 注册绑定门面
     */
    public function register()
    {
        //注册Api
        $this->registerApi();
    }

    public function registerApi(){

        $this->app->bind(ApiFacade::class, function () {
            return app()->make(ApiService::class);
        });
    }
}
