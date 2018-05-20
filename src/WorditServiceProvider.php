<?php

namespace Akuriatadev\Wordit;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Akuriatadev\Wordit\Traits\WorditTrait;

class WorditServiceProvider extends ServiceProvider
{
    use WorditTrait;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerGates();

        // Load routes
        include_once __DIR__.'/routes/routes.php';

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        // Publish assets
        $this->publishes([
            __DIR__.'/public' => public_path('vendor/wordit'),
        ], 'wordit-assets');

        // Config
        $this->publishes([
            __DIR__.'/config/wordit.php' => config_path('wordit.php'),
        ]);

        // Seeds
        $this->publishes([
            __DIR__.'/seeds' => database_path('seeds')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         // Load views
         $this->loadViewsFrom(__DIR__.'/views', 'wordit');

         // Merge config
         $this->mergeConfigFrom(
             __DIR__.'/config/wordit.php', 'wordit'
         );
    }

    public function registerGates() {
        foreach ($this->getAllPermissionsFillable() as $permKey => $permName) {
            Gate::define($permKey, function ($user) use ($permName) {
                return $user->hasPermission($permName);
            });
        }
    }
}
