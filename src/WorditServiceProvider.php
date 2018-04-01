<?php

namespace Akuriatadev\Wordit;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class WorditServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes
        include_once __DIR__.'/routes/routes.php';

        // Publish assets
        $this->publishes([
            __DIR__.'/public' => public_path('vendor/wordit'),
        ], 'wordit-assets');

        // Config
        $this->publishes([
            __DIR__.'/config/wordit.php' => config_path('wordit.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Load controllers
        $this->app->make('Akuriatadev\Wordit\Controllers\DashboardController');

         // Load views
         $this->loadViewsFrom(__DIR__.'/views', 'wordit');

         // Merge config
         $this->mergeConfigFrom(
             __DIR__.'/config/wordit.php', 'wordit'
         );
    }
}
