<?php

namespace Indotcode\Calendar;

use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'calendar');

        $this->loadViewsFrom(__DIR__.'/views', 'calendar');

        $this->publishes([
            __DIR__.'/css' => public_path('calendar'),
        ], 'public');

//        $this->publishes([
//            __DIR__.'/config/config.php' => config_path('indotcodeField.php'),
//        ]);
//
//        $this->publishes([
//            __DIR__.'/views' => resource_path('views/indotcodeField'),
//        ]);
    }
}
