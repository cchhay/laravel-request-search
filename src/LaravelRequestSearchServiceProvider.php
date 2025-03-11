<?php

namespace Cchhay\LaravelRequestSearch;

use Illuminate\Support\ServiceProvider;

class LaravelRequestSearchServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot(): void
    {
        // $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function register(): void
    {
        // $this->registerPublishables();
        $this->registerBindings();
    }

    /**
     * Public configuration file into laravel configuration path.
     */
    private function registerPublishables()
    {
        $publishableConfigs = [
            'config' => [
                __DIR__ . '/config/requestsearch.php' => config_path('requestsearch.php'),
            ],
        ];
        foreach ($publishableConfigs as $publish => $paths) {
            $this->publishes($paths, $publish);
        }
    }

    /**
     * Register spellnumber Number Class into service provider with it configuration setting.
     */
    protected function registerBindings()
    {
        $this->app->singleton('RequestSearch', function () {
            return new RequestSearch(config('requestsearch'));
        });
    }
}
