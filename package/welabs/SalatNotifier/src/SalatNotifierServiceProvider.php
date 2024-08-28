<?php 

namespace welabs\SalatNotifier;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use welabs\SalatNotifier\Console\NotifySalatTimes;
use Illuminate\Console\Events\ArtisanStarting;

class SalatNotifierServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge the package config file with the application's config
        $this->mergeConfigFrom(__DIR__ . '/../config/salatnotifier.php', 'salatnotifier');

        // Bind the SalatTimeManager to the service container
        $this->app->singleton('SalatTimeManager', function ($app) {
            return new SalatTimeManager();
        });
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'salatnotifier');

        // Load package migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/salatnotifier.php' => config_path('salatnotifier.php'),
        ]);

        // Register console commands if running in console
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\NotifySalatTimes::class,
            ]);
        }

        $this->app['events']->listen(ArtisanStarting::class, function () {
            $this->app->make(Schedule::class)->command('salat:notify')->everyMinute();
        });

    } 

}
