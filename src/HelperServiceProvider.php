<?php

namespace TobyMaxham\Helper;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tma-helper.php' => config_path('tma-helper.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__.'/../config/tma-helper.php', 'tma-helper');
    }
}
