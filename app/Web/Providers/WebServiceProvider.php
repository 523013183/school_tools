<?php
namespace App\Web\Providers;

use App\Base\Providers\AppServiceProvider;

class WebServiceProvider extends AppServiceProvider
{
    public function boot()
    {
        $this->registerComponent();
        parent::boot();
    }

    /**
     * 注册组件
     */
    private function registerComponent()
    {
    }
}
