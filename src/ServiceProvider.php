<?php

namespace ISaadSalman\StatamicAnalytics;

use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use ISaadSalman\StatamicAnalytics\Http\Middleware\Analytics;


class ServiceProvider extends AddonServiceProvider
{
    // https://statamic.com/addons/jack-whiting/plausible
    // https://github.com/andreaselia/laravel-analytics


    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php'
    ];

    protected $scripts = [
        __DIR__ . '/../dist/js/statamic-analytics.js'
        // __DIR__ . 'dist/js/statamic-analyticss.js'
    ];


    protected $middlewareGroups = [
        'web' => [
            Analytics::class
        ],
    ];


    public function boot()
    {
        parent::boot();

        $this->createNavigation();

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'statamic-analytics');
        $this->mergeConfigFrom(__DIR__ . '/../config/statamic-analytics.php', 'statamic-analytics');
        $this->publishAssets();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/statamic-analytics.php' => config_path('statamic-analytics.php'),
            ], 'statamic-analytics-config');
        }   
    }


    private function createNavigation(): void
    {


        Nav::extend(function ($nav) {
            $nav->create('Analytics')
                ->icon('charts')
                ->section('Tools')
                ->route('statamic-analytics.index');
        });
    }

    private function publishAssets(): void
    {
        Statamic::afterInstalled(function () {
            Artisan::call('vendor:publish --tag=statamic-analytics-config');
        });
    }
}
