<?php

namespace Laraflow\TripleA;

use Illuminate\Support\ServiceProvider;

class TripleAServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //config
        $this->publishes([
            __DIR__ . '/../config/triplea.php' => config_path('triplea.php'),
            __DIR__ . '/../config/audit.php' => config_path('audit.php'),
            __DIR__ . '/../config/auth.php' => config_path('auth.php'),
            __DIR__ . '/../config/laratrust.php' => config_path('laratrust.php'),
        ], 'triplea-config');

        //route
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        //migration
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        //translation
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'triplea');

        $this->publishes([
            __DIR__ . '/../resources/lang' => $this->app->langPath('vendor/triplea/lang'),
        ], 'triplea-lang');

        //view
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'triplea');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/triplea'),
        ], 'triplea-view');

        //asset
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/triplea'),
        ], 'triplea-asset');
    }

    public function register()
    {
        //config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/triplea.php',
            'triplea'
        );
    }
}
