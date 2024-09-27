<?php

namespace App\Base\Providers;

use Illuminate\Support\ServiceProvider;
use App\Base\Exceptions\ApiException;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
