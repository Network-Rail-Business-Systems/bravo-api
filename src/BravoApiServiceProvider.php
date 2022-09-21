<?php

namespace NetworkRailBusinessSystems\BravoApi;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class BravoApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/bravo-api.php' => config_path('bravo-api.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../config/bravo-api.php',
            'bravo-api'
        );

        PendingRequest::macro('proxy', function (string $url) {
            /** @var PendingRequest $this */
            if (App::environment(['staging', 'production']) === false) {
                return $this;
            }

            return tap($this, function () use ($url) {
                /** @var PendingRequest $this */
                $this->options['proxy'] = $url;
            });
        });
    }
}
